<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
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
        Yii::app()->session['leveluser'] = 'guest';
        $sql = "select * from t_useradmin where username = '$this->username' and passwd = md5('$this->password')";
//        $sql->execute(array($this->username,$this->password));

        $data = Yii::app()->db->createCommand($sql)->queryRow();
        if($data){
            Yii::app()->session['leveluser'] = 'admin';
            $this->errorCode = self::ERROR_NONE;
        }else{
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        return !$this->errorCode;

//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);

//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
////		elseif($users[$this->username]!==$this->password)
////			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
	}
}