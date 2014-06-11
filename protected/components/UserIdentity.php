<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    const ERROR_TYPEUSER_INVALID = 13;

    private $_id;

    // private $_isAdmin;

    public function authenticate() {
        Yii::import('application.vendor.passwordEncrypt');
        $username = strtolower($this->username);
        $criteria = new CDbCriteria();
        $criteria->alias = 'users';
        $criteria->addCondition('users.username = ?');
        $criteria->params = array($username);
        $user = MdlUser::model()->find($criteria);
        //echo '<pre>'.$this->password; print_r($user);exit();
        if ($user === null) {
            return $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $mypassword = $this->password;
            if (!passwordEncrypt::password_verify($mypassword, $user->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_id = $user->id;
               
                $auth = Yii::app()->authManager;

                $this->errorCode = self::ERROR_NONE;
            }
        }
    }

    /*
      public function getIsAdmin(){
      return $this->_isAdmin;

      }
     */

    public function getId() {
        return $this->_id;
    }

}
