<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('email'=>$this->username));
		if ($user === null) {
		    // No user found!
		    $this->errorCode=self::ERROR_USERNAME_INVALID;
		} elseif (!password_verify($this->password, $user->pass)) {
		    // Invalid password!
		    $this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else { // Okay!
		    $this->errorCode=self::ERROR_NONE;

		    // Store the type in the session:
		    $this->setState('type', $user->type);

		    // Store the user ID:
		    $this->_id = $user->id;

		    // Store the username in the session:
		    $this->username = $user->username;

		}
		return !$this->errorCode;
	}

   public function getId() {
        return $this->_id;
	}

}