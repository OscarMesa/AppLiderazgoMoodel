<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilidades
 *
 * @author omesa
 */
class Utilidades {

//put your code here
    public static function hola() {
        echo 'hola';
    }

    public static function popDropBox($data) {
        $links = '';
        foreach ($data as $row) {
            $links .= '<li><a href="' . Yii::app()->baseUrl . '/protected/data/adjuntos/' . $row->filename . '">' . $row->filename . '</a></li>';
        }
        return $links;
    }

    public static function generarLink($data) {
        return $data->revisionMax == 0 ? '<a href="' . Yii::app()->createUrl('programa/subirArchivo/' . $data->id) . '" class="btn btn-small"><i class="icon-upload "></i></a>' : '';
    }

    public static function generarEstado($data, $perfil) {
        if ($perfil != null && count($data->adjuntos) > 0) {
            $max = $data->revisionMax;
            $estado = TipoEstadoRevision::model()->findByPk($max);
            switch ($max) {
                case 1:
                    return $perfil->id == 8 ? '<a href="' . Yii::app()->createUrl('programa/ActualizaEstado/' . $data->id . '/1') . '" class=""><i>' . $estado->nombre_estado . '</i></a>' : '<p>' . $estado->nombre_estado . '<p/>';
                    break;
                case 2:
                    return $perfil->id == 7 ? '<a href="' . Yii::app()->createUrl('programa/ActualizaEstado/' . $data->id . '/2') . '" class=""><i>' . $estado->nombre_estado . '</i></a>' : '<p>' . $estado->nombre_estado . '<p/>';
                    break;
                case 3:
                    return $perfil->id == 7 ? '<a style="color:red;" href="' . Yii::app()->createUrl('programa/ActualizaEstado/' . $data->id . '/3') . '" class=""><i>' . $estado->nombre_estado . '</i></a>' : '<p>' . $estado->nombre_estado . '<p/>';
                    break;
                case 4:
                    return $perfil->id == 8 ? '<a href="' . Yii::app()->createUrl('programa/ActualizaEstado/' . $data->id . '/4') . '" class=""><i>' . $estado->nombre_estado . '</i></a>' : '<p>' . $estado->nombre_estado . '<p/>';
                    break;
                case 5:
                    return $perfil->id == 8 ? '<a style="color:red;" href="' . Yii::app()->createUrl('programa/ActualizaEstado/' . $data->id . '/5') . '" class=""><i>' . $estado->nombre_estado . '</i></a>' : '<p>' . $estado->nombre_estado . '<p/>';
                    break;
            }
        }
        return '';
    }

    /**
     * Como un usuario puede tener varios perfiles o pertenecer a varios grupos, me interesa saber su perfil especificamente, si es administrador, es super administrador(8) de nettic y si es administrador (7) es usuario administrador normal de resto no me interesa 
     * @param Object $perfiles
     * @return null | Object
     */
    public static function validarTipoUsuario($perfiles) {
        $configPerfil = null;
        foreach ($perfiles as $perfil) {
            if ($perfil->id == 7)
                $configPerfil = $perfil;
            if ($perfil->id == 8) {
                $configPerfil = $perfil;
                return $perfil;
            }
        }
        return $perfil;
    }

    public static function generarLinkActInactUsuario($estado, $id) {
        return ($estado == 'active' ? '<a href="' . Yii::app()->createUrl('usuarios/inactive/' . $id) . '" class="btn btn-small"><i class="icon-hand-down"></i>Innactivar</a>' : '<a href="' . Yii::app()->createUrl('usuarios/active/' . $id) . '" class="btn btn-small"><i class="icon-hand-up"></i>Activar</a>');
    }

    public static function generarLinkEditarUsuario($id) {
        return '<a href="' . Yii::app()->createUrl('usuarios/update/' . $id) . '" class="btn btn-small"><i class="icon-edit "></i></a>';
    }

    public static function generarLiPerfiles($perfiles) {
        foreach ($perfiles as $perfil) {
            echo '<p><i class="icon-user"></i>' . $perfil->nombre . '</p>';
        }
    }

    public static function getDelimiter($file) {
        $delimiter = false;
        $line = '';
        if ($f = fopen($file, 'r')) {
            $line = fgets($f); // read until first newline
            fclose($f);
        }
        if (strpos($line, ';') !== FALSE && strpos($line, ',') === FALSE) {
            $delimiter = ';';
        } else if (strpos($line, ',') !== FALSE && strpos($line, ';') === FALSE) {
            $delimiter = ',';
        } else {
            die('Unable to find the CSV delimiter character. Make sure you use "," or ";" as delimiter and try again.');
        }
        return $delimiter;
    }

}

?>
