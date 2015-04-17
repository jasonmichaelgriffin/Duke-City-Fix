DROP TABLE IF EXISTS Profile;
DROP TABLE IF EXISTS blogPost;
DROP TABLE IF EXISTS blogComment;

CREATE TABLE profile (
  userId INT UNSIGNED AUTO-INCREMENT NOT NULL ,
  eMail VARCHAR(40) NOT NULL,
  userName VARCHAR(30) NOT NULL,
  country VARCHAR(3),
  postalCode INT UNSIGNED,
  neighborhood VARCHAR(100),
  aboutMeComment TINYTEXT,
  businessOrPerson VARCHAR(8),
  gender VARCHAR(1),
  PRIMARY KEY(userID),
  UNIQUE(email),
/*In "real life" I would have both businessOrPerson and gender be foreign keys attached to tables with just the values I want to accept limiting the valid options to the end user.*/
);

CREATE TABLE blogPost (
	blogId INT UNSIGNED AUTO-INCREMENT NOT NULL,
	userId INT UNSIGNED NOT NULL,
	blogTitle varchar (100) NOT NULL,
	content MEDIUMTEXT,
	publishDate DATETIME NOT NULL,
	INDEX (publishDate),
	INDEX (userID),
	INDEX (blogTitle),
	PRIMARY KEY (blogID),
	FOREIGN KEY (userID) REFERENCES profile(userID),
;

CREATE TABLE blogComment (
	commentId INT UNSIGNED AUTO-INCREMENT NOT NULL,
	userId INT NOT NULL





);


