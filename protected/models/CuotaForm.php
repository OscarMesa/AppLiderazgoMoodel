<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CuotaForm
 *
 * @author oskar
 */
class CuotaForm extends CFormModel {

    public $csvFile;
    public $consecutivos;
    public $cuota;
    public $usuario;

    public function rules() {
        return array(
            // username and password are required
            array('csvFile, consecutivos', 'required'),
            array('csvFile', 'file', 'allowEmpty' => true, 'types' => 'txt'),
            array('consecutivos,cuota,usuario', 'numerical', 'integerOnly' => true)
        );
    }

    public function attributeLabels() {
        return array(
            'csvFile' => 'Archivo txt',
            'consecutivos' => 'Cantidad de cursos a activar por cuota',
        );
    }

}
