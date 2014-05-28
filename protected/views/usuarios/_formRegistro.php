<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'usuarios-form',
    'action' => $this->createUrl('usuarios/createAnonimo'),
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    ),
    'htmlOptions' => array(
        'class' => 'well',
    ),
        ));
?>

<?php

echo $form->textFieldRow($modelRegistro, 'nombre', array('class' => 'span3'));

echo $form->passwordFieldRow($modelRegistro, 'contrasena', array('class' => 'span5', 'maxlength' => 40));

echo $form->passwordFieldRow($modelRegistro, 'passConfirm', array('class' => 'span5', 'maxlength' => 40));

echo $form->textFieldRow($modelRegistro, 'correo', array('class' => 'span3'));

$model_perfil_v = new Perfiles();
echo $form->dropDownListRow($model_perfil_v, 'id_perfil', CHtml::listData(Perfiles::model()->findAll("id_perfil IN(4,5)"), 'id_perfil', 'nombre'));
echo"<br>";
$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Guardar Registro'));


$this->endWidget();
?>
