<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'nombre',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'apellido1',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'apellido2',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->passwordFieldRow($model,'contrasena',array('class'=>'span5','maxlength'=>40)); ?>
	
        <?php echo $form->passwordFieldRow($model,'passConfirm',array('class'=>'span5','maxlength'=>40)); ?>
        
	<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'celular',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'correo',array('class'=>'span5','maxlength'=>50)); ?>

        <?php echo $form->dropDownListRow($model,'state_usuario',  array('active'=>'Activo','inactive'=>'Innactivo'),array('class'=>'span5',)); ?>
        
        <div class="bs-default bs-perfiles">
            <?php
                echo $form->checkBoxListRow(new Perfiles(), '', CHtml::listData(Perfiles::model()->findAll('state_perfiles="active"'), 'id_perfil', 'nombre'), array('select'=>$model->perfiles, 'hint'=>'<strong>Nota:</strong> Estos son todos los perfiles que tiene asignado un usuario.')); 
            ?>
        </div>
        
        <div class="bs-default bs-universidades">
            <?php
                echo $form->checkBoxListRow(new Universidad(), '', CHtml::listData(Universidad::model()->findAll('state_universidad="active"'), 'id_universidad', 'nombre_universidad'), array('select'=>$model->universidads, 'hint'=>'<strong>Nota:</strong> Estos son las universidades en las cuales este usuario a pertenecido.')); 
            ?>
        </div>
        
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
