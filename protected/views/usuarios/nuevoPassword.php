<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usuarios-form',
        'action' => Yii::app()->getBaseUrl(true).'/usuarios/GuardarCambioNuevoPassword',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
));
?>

<p class="help-block">Debe diligenciar los dos campos de contraseña para realizar el cambío,  <span class="required">*</span> recuerde que los dos campos son necesarios.</p>

        <?php echo $form->passwordFieldRow($model,'contrasena',array('class'=>'span5','maxlength'=>40)); ?>
	
        <?php echo $form->passwordFieldRow($model,'passConfirm',array('class'=>'span5','maxlength'=>40)); ?>

        <?php echo CHtml::hiddenField('Usuarios[id_usuario]', $model->id_usuario); ?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=> 'Cambiar',
		)); ?>
</div>
<?php $this->endWidget(); ?>

