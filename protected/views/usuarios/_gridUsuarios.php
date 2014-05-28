<?php

Yii::import('application.vendor.*');

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'lista-programas',
    'dataProvider' => $dataProvider,
    //'filter' => V7guiK2Items::model(),
    'type' => 'striped bordered condensed',
    'columns' => array(
        array(
            'type' => 'raw',
            'header' => 'Nombre',
            'value' => function($data) {
                return $data->nombre . ' ' . $data->apellido1;
            }),
        array(
            'type' => 'raw',
            'header' => 'Correo',
            'value' => '$data->correo'
        ),
        array(
            'type' => 'raw',
            'header' => 'Perfiles',
            'value' => 'Utilidades::generarLiPerfiles($data->perfiles)'
        ),
        array(
            'type' => 'raw',
            'header' => 'Estado',
            'value' => function ($data) {
                return $data->state_usuario == 'active' ? 'Activo' : 'Inactivo';
            },
        ),
        array(
            'type' => 'raw',
            'header' => 'Activar/Inactivar',
            'value' => 'Utilidades::generarLinkActInactUsuario($data->state_usuario,$data->id_usuario)',
        ),
        array(
            'type' => 'raw',
            'header' => 'Editar',
            'value' => 'Utilidades::generarLinkEditarUsuario($data->id_usuario)',
        ),
    ),
        )
);
?>
