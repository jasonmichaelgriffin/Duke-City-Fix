DROP TABLE IF EXISTS blogComment;
DROP TABLE IF EXISTS blogPost;
DROP TABLE IF EXISTS dcfProfile;

CREATE TABLE dcfProfile (
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL ,
	eMail VARCHAR(40) NOT NULL,
	userName VARCHAR(30) NOT NULL,
	country VARCHAR(3),
	postalCode INT UNSIGNED,
	neighborhood VARCHAR(100),
	aboutMeComment TINYTEXT,
	businessOrPerson VARCHAR(8),
	gender VARCHAR(1),
	PRIMARY KEY(userId),
	UNIQUE(eMail),
	UNIQUE (userName)/*In "real life" I would have both businessOrPerson and gender be foreign keys attached to tables with just the values I want to accept limiting the valid options to the end user.*/
);

CREATE TABLE blogPost (
	blogId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userId INT UNSIGNED NOT NULL,
	blogTitle varchar (100) NOT NULL,
	content MEDIUMTEXT,
	publishDate DATETIME NOT NULL,
	INDEX (publishDate),
	INDEX (userId),
	INDEX (blogTitle),
	PRIMARY KEY (blogId),
	FOREIGN KEY (userId) REFERENCES dcfProfile(userId)
);

CREATE TABLE blogComment (
	commentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userId INT UNSIGNED NOT NULL,
	blogId INT UNSIGNED NOT NULL,
	timestamp TIMESTAMP,
	comment VARCHAR (255) NOT NULL,
	PRIMARY KEY (commentId),
	INDEX (userId),
	INDEX (blogId),
	FOREIGN KEY (userId) REFERENCES dcfProfile(userId),
	FOREIGN KEY (blogId) REFERENCES blogPost(blogId)
);