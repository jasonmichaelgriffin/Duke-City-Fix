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
	 * @param int $newDcfProfile id of the profile.  Null if new profile
	 * @param string $newEMail The e-mail of the user
	 * @param string $newUserName the username
	 * @throws EXCEPTION IF EMAIL IS NOT FORMATTED AS A VALID E-MAIL (using the fallible email format validator we went over yesterday
	 * @throws EXCEPTION OF USERNAME IS EMPTY/NULL
	 */
	public function __construct($newUserId, $newEMail, $newUserName) {
		// TODO: finish this try block
		/**try {
			$this->setUserID($newUserId);
			$this->setEmail($newEMail);
			$this->setUserName($newUserName);
		} /**catch INSERT CATCHES HERE FOR THE EXCEPTIONS THROWN IN THE ABOVE FUNCTIONS, BE SURE TO INCLUDE A FINAL ONE USING EXCEPTION TO CATCH ANY MISSED.
			**/
	}
	/**
	 * access method for userId
	 *
	 * @return INT value of user id
	 */
	public function getUserID () {
		return($this->userId);
	}

	/**
	 * mutator method for userID
	 * TODO: fill in @param and @throws for the below setUserID
	 *
	 */
	// TODO: write setUserID()
	//TODO:  Ask Dylan - if we always want to auto-increment the ID and never allow someone/thing to manually define it couldn't we just have this setUserID define it as null and leave it at that?
	public function setUserID() {
	}

	/**
	 * accessor method for eMail
	 *
	 * @return string value of eMail
	 **/
	public function getEMail () {
		return ($this->eMail);
	}

	/**
	 * mutator method for eMail
	 *
	 * @param string $newEMail new value for eMail
	 * @throws InvalidArgumentException if $newEMail is empty
	 * @throws InvalidArgumentException if $newEMail is not in a valid format per FILTER_VALIDATE_EMAIL
	 * 	 * TODO:  fill in @param and @throws for the below setEMAIL
	 */


	public function setEMail($newEMail) {
		//Checks if $newEMail is empty
		if(empty ($newEMail) === true) {
			throw(new InvalidArgumentException("Email field cannot be empty"));
		}
		// trim any white space
		$newEMail = trim($newEMail);

		//Remove all characters except letters, digits, and !#$%&'*+-/=?^_`{|}~@.[].
		$newEMail = (filter_var($newEMail, FILTER_SANITIZE_EMAIL));

		// validate e-mail format
		if(filtervar(@newEMail, FILTER_VALIDATE_EMAIL) === false) {
			throw(new InvalidArgumentException("Submitted eMail $newEMail is not in a valid format"));
		}

		// convert and store the eMail
		$this->eMail = $newEMail;
	}


	/**
	 * accessor method for userName
	 *
	 *@return string value of userName
	 **/
	public function getUserName() {
		return($this->userName);
	}

	/**
	 * mutator method for userName
	 *
	 * TODO:  fill in @param and @throws for the below setUserName
	 */
	//TODO:  write setUserName()
	public function setUserName() {
	}

}
/**
 *
 */