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

    public function rules() {
        return array(
            // username and password are required
            array('csvFile, consecutivos', 'required'),
            array('csvFile', 'file', 'allowEmpty' => true, 'types' => 'csv'),
            array('consecutivos', 'numerical', 'integerOnly' => true)
        );
    }

    public function attributeLabels() {
        return array(
            'csvFile' => 'Archivo csv',
            'consecutivos' => 'Cantidad de cursos a activar por cuota',
        );
    }

}
