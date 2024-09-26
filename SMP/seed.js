var User = require('./models/User.js');

var user = {
    name: "Admin User",
    email: "admin@gmail.com",
    role: "admin",
    password:111111
}

User.create(user, function(e) {
    if (e) {
        throw e;
    }
});