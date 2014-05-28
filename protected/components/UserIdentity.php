<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_TYPEUSER_INVALID = 13;
    private $_id;
    private $_perfiles;
    private $_username;
    // private $_isAdmin;

    public function authenticate()
    {
        $username=strtolower($this->username);
        $criteria = new CDbCriteria();
        $criteria->alias = 'users';
        $criteria->addCondition('users.correo = ?');
        $criteria->params = array($username);
        $user = Usuarios::model()->find($criteria);
        if($user===null){
           return $this->errorCode=self::ERROR_USERNAME_INVALID;
        }else{
            $mypassword=$this->password;
            $encrypted_password = sha1($mypassword);
            if($user->contrasena!=$encrypted_password){
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else{
                $this->_id=$user->id_usuario;
                $this->_perfiles = $user->perfiles;
                $this->_username = $user->nombre;
               // $this->setState('role', $user->rol);
               //  $this->setState('admin', 1);

                            $auth=Yii::app()->authManager;
                            /*
                            $bizRule='return !Yii::app()->user->isGuest;';
                            $auth->createRole('authenticated', 'authenticated user', $bizRule);

                            $bizRule='return Yii::app()->user->isGuest;';
                            $auth->createRole('guest', 'guest user', $bizRule);

                            $bizRule='return Yii::app()->user->isAdmin;';
                            $auth->createRole('admin', 'admin user', $bizRule);
                            */
                            //$auth->assign('admin',$this->id);

               // $this->email=$user->email;
                $this->errorCode=self::ERROR_NONE;
            }
        }
    }
    /*
    public function getIsAdmin(){
	    return $this->_isAdmin;
    	
    }
    */
 
    public function getId()
    {
        return $this->_id;
    }
    
    public function  getPerfiles()
    {
        return $this->_perfiles;
    }
    
    public function getUser()
    {
        return $this->_username ;
    }

}