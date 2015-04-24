<?php
// first, require the AES 256 encryption functions
require_once("/etc/apache2/data-design/encrypted-config.php");

// stick all other required_once here (in this case it's the class being tested)
require_once ("dcfprofile.php");

// here do the test

try {
	//  $config = readConfig("/etc/apache2/data-design/database-config.ini");
	$config = readConfig("/etc/apache2/data-design/jgriffin.ini");

	//create a data connection string (DSN) & specify the user name and password
	$dsn = "mysql:host=" . $config["hostname"] . ";dbname=" . $config["database"];

	// enable UTF-8 (Unicode) text handling
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

	// connect to MYsql via pdo
	$pdo = new PDO($dsn, $config["username"], $config["password"], $options);

	//have PDO throw exceptions whenever possible
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//insert the stuff I'm testing here
	// create a new DCF Profile TODO: complete this section
	$profile = new DcfProfile(1, "zaphod@heartofgold.com", "FroodyDude");

	// Catch Exceptions.  TODO:  Here too shouldn't we be including the high level Exception catch in addition to PDOException?  Ask Dylan or Eric
} catch(PDOException $pdoException) {
	echo "Exception: " . $pdoException->getMessage();

}
//  TODO:  Ask why this closing tag is considered redundant by PHP
?>