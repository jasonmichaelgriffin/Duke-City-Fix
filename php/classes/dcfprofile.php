<?php
/**
 *Creating a user profile
 *
 *This class handles the profile entity for DCF.  With minor changes it can be re-used/applied to other profile creation needs.
 *
 * @author Jason Griffin jgriffin31@cnm.edu
 **/
class DcfProfile {
	/**
	 * User ID.  This is the primary key.  It is not meant to be visible to the user.
	 * @var int $userId
	 */
	private $userId;
	/**
	 * eMail The user will use this to login and hence it's unique.
	 * @var string
	 */
	private $eMail;
	/**
	 * User Name
	 * @var string
	 */
	private $userName;


	/**
	 * constructor for profile creation
	 *
	 * @param int $newUserId id of the profile.  Null if new profile
	 * @param string $newEMail The e-mail of the user
	 * @param string $newUserName the username
	 * @throws InvalidArgumentException if data types are not valid
	  *@throws RangeException if $newUserId is not positive
	 **/
	public function __construct($newUserId, $newEMail, $newUserName) {
		try {

			$this->setUserID($newUserId);
			$this->setEmail($newEMail);
			$this->setUserName($newUserName);
		} catch(InvalidArgumentException $invalidArgument) {
			//  Rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			//  Rethrow the exception to the caller
			throw(new RangeException($range->getMessage (), 0, $range));
		} catch(Exception $exception) {
			//Rethrow the exception to the caller
			throw(new PDOException($exception->getMessage (), 9, $exception));
		}
	}

	/**
	 * access method for userId
	 *
	 * @return INT value of user id
	 */
	public function getUserID() {
		return ($this->userId);
	}

	/**
	 * mutator method for userID
	 *
	 *@param int $newUserId new userID
	 *@throws InvalidArgumentException if $newUserID is not an integer
	 *@throws RangeException if $newUserID is not positive
	 *	 */
		public function setUserID($newUserId) {

		//verify the userid is valid
		filter_var($newUserId, FILTER_VALIDATE_INT);
		if($newUserId === false) {
			throw(new InvalidArgumentException("User ID must be an integer"));
		}
		//verify the userid is positive
		if($newUserId <= 0) {
			throw(new RangeException("User ID Must Be Positive"));
		}

		//convert and store the userID
		$this->userId = intval($newUserId);
	}

	/**
	 * accessor method for eMail
	 *
	 * @return string value of eMail
	 **/
	public function getEMail() {
		return ($this->eMail);
	}

	/**
	 * mutator method for eMail
	 *
	 * @param string $newEMail new value for eMail
	 * @throws InvalidArgumentException if $newEMail is empty
	 * @throws InvalidArgumentException if $newEMail is not in a valid format per FILTER_VALIDATE_EMAIL
	 **/

	public function setEMail($newEMail) {
		//  Checks if $newEMail is empty
		if(empty ($newEMail) === true) {
			throw(new InvalidArgumentException("Email field cannot be empty"));
		}
		//  Trim any white space
		$newEMail = trim($newEMail);

		//  Remove all characters except letters, digits, and !#$%&'*+-/=?^_`{|}~@.[].
		$newEMail = (filter_var($newEMail, FILTER_SANITIZE_EMAIL));

		//  Validate e-mail format
		if(filter_var($newEMail, FILTER_VALIDATE_EMAIL) === false) {
			throw(new InvalidArgumentException("Submitted eMail $newEMail is not in a valid format"));
		}

		// Convert and store the eMail
		$this->eMail = $newEMail;
	}


	/**
	 * accessor method for userName
	 *
	 * @return string value of userName
	 **/
	public function getUserName() {
		return ($this->userName);
	}

	/**
	 * mutator method for userName
	 *
	 * @param string $newUserName new value of user name
	 * @throw InvalidArgumentException if $userName is null
	 */
	public function setUserName($newUserName) {
		//checks if $newUserName is null
		if($newUserName === null) {
			throw (new InvalidArgumentException("User Name cannot be blank"));
		}
		//  Trims space in $newUserName
		$newUserName = trim($newUserName);

		//  Sanitize $newUserName to remove tags
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING);

		// Convert and store the email
		$this->userName = $newUserName;
	}

	/**
	 * Inserts this dcfProfile into mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @throws PDOException when mySQL related errors occur
	 */
	public function insert(PDO &$pdo) {

		// force userId to be null, throwing an exception if it is not (and hence already exists)
		if($this->userId !== null) {
			throw(new PDOException("not a new userId"));
		}

		//create query template
		$query = "INSERT INTO dcfProfile(userId, eMail, userName) VALUES(:userID, :eMail, ,:userName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = array("userId" => $this->userId, "eMail" => $this->eMail, "userName" => $this->userName);
		$statement->execute($parameters);

		// populate the userId that was previously null with what mySQL just assigned (so the object holds what was populated into the database).
		$this->userID = intval($pdo->lastInsertId());
	}

	/**
	 * updates this dcfProfile in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function update(PDO &$pdo) {
		//  force userID to not be null (only update pre-existing user profiles)
		if($this->userID === null) {
			throw (new PDOException( "Can't update a user profile that does not already exist"));
		}

		//create query template
		$query = "UPDATE dcfProfile SET userID = :userID, eMail = :eMail, userName = :userName WHERE userID = :userID";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = array("userId" => $this->userId, "eMail" => $this->eMail, "userName" => $this->userName);
		$statement->execute($parameters);
	}

	/**
	 * Deletes a dcfProfile in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @throws PDOException when mySQL related errors occur
	 */
	public function delete(PDO &$pdo) {
		// force userID to not be null; can't delete a dcfProfile that does not exist
		if($this->userId !== null) {
			throw(new PDOException("not a new userId"));
		}
		//create query template
		$query = "DELETE FROM dcfProfile WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = array("userId" => $this->userId);
		$statement->execute($parameters);
	}

	/** TODO: write getFooByPrimaryKey
	 **/


	/** TODO: write getFooBy(userName)
	 **/





//  Class closing tag (mentioned just for code tracking purposes
}
