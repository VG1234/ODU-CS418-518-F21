const express = require('express');
const router = express.Router();
const bcrypt = require('bcryptjs');
const passport = require('passport');

//User model
const User = require('../models/User');
const { forwardAuthenticated } = require('../config/auth');

// Login Page
router.get('/login',forwardAuthenticated, (req, res)=>res.render("login"));
// Register Page
router.get('/register',forwardAuthenticated, (req, res)=>res.render("register"));
// Find back
router.get('/findback', forwardAuthenticated, (req, res)=>res.render("findback"))

// Register Handle
router.post('/register',(req, res)=>{
    const { name, email, password, password2,phonenumber } = req.body;
    let errors = [];

    //check required fields
    if(!name || !email || !password || !password2){
        errors.push({msg: 'Please fill in all fields'});
    }
    // Check password match
    if (password !== password2) {
        errors.push({msg: 'Password do not match'});
    }
    // Check password length
    if (password.length < 6){
        errors.push({msg: 'Password should be at least 6 characters'});
    }
    if(errors.length >0){
        res.render('register',{errors, name, email, password, password2, phonenumber});
    }
    else{
        User.findOne({email:email}).then(user => {
            if(user){
                // User exists
                errors.push({msg: "Email is already registered"});
                res.render('register', {
                    errors,
                    name,
                    email,
                    password,
                    password2,
                    phonenumber});
        } else {
            const newUser = new User({
                name,
                email,
                password,
                phonenumber
            });
            // Hash Password
            bcrypt.genSalt(10,(err, salt) => {
                bcrypt.hash(newUser.password, salt, (err, hash)=>{
                    if(err) throw err;
                    // Set password to hashed
                    newUser.password = hash;
                    //Save User
                    newUser.save()
                    .then( user=> {
                        req.flash('success_msg','You are now registered and can log in');
                        res.redirect('/users/login');
                    })
                    .catch(err => console.log(err));
                });
            })
        }
    });
}
});

//Login handle
router.post('/login', (req, res, next)=>{
    passport.authenticate('local',{
        successRedirect:'/dashboard',
        failureRedirect:'/users/login',
        failureFlash: true
    })(req, res, next);
});

//Logout handle
router.get('/logout', (req, res)=>{
    req.logout();
    req.flash('success_msg','You are logged out');
    res.redirect('/users/login');
});

//Findback handle
router.post('/findback', (req, res)=>{
    req.flash('success_msg','Password was sent to your email address!');
    res.redirect('/users/login');
})

module.exports = router;