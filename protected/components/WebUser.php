<?php

class WebUser extends CWebUser
{
    private $perfiles;
    public function __get($name)
    {
        if ($this->hasState('__userInfo')) {
            $user=$this->getState('__userInfo',array());
            if (isset($user[$name])) {
                return $user[$name];
            }
        }
 
        return parent::__get($name);
    }
 
    public function login($identity, $duration) {
        $this->setState('__perfiles', $identity->getPerfiles());
        $this->setState('idUsuario', $identity->getId());
//       echo "<pre>";
//        print_r($this->perfiles);
//                exit();
        parent::login($identity, $duration);
    }
 
    /* 
    * Required to checkAccess function
    * Yii::app()->user->checkAccess('operation')
    */
    public function getId()
    {
        return $this->idUsuario;
    }
    
    public function getPerfiles_1()
    {
        echo 'desde';
        print_r($this->perfiles);
        return $this->perfiles;
    }
    
    public function esAdmin()
    {
        foreach (Yii::app()->user->__perfiles as $perfil) {
            if($perfil->id_perfil == 6)
            {
                return TRUE;
            }
        }
        return false;
  
      }
    
    public function esProfesor()
    {
        foreach (Yii::app()->user->__perfiles as $perfil) {
            if($perfil->id_perfil == 4)
            {
                return TRUE;
            }
        }
        return false;
    }
}
?>