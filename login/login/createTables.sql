
CREATE TABLE userprofile(
	userid varchar(50) NOT NULL,
	firstname varchar(50) DEFAULT NULL,
	lastname varchar(50) dEFAULT NULL,
	email varchar(50) NOT NULL,
	password varchar(1024) DEFAULT NULL,
	CONSTRAINT PK_userprofile PRIMARY KEY (email)
)
