DROP TABLE IF EXISTS Profile;
DROP TABLE IF EXISTS blogPost;
DROP TABLE IF EXISTS blogComment;

CREATE TABLE profile (
  userID INT UNSIGNED PRIMARY KEY AUTO-INCREMENT NOT NULL ,
  eMail VARCHAR(40) NOT NULL,
  userName VARCHAR(30) NOT NULL,
  country VARCHAR(3),
  postalCode INT UNSIGNED,
  neighborhood VARCHAR(100),
  aboutMeComment TINYTEXT,
  businessOrPerson VARCHAR(8)
  gender VARCHAR(1),
/In "real life" I would have both businessOrPerson and gender be foreign keys attached to tables with just the values I want to accept limiting the valid options to the end user.
);
