<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'subir-cuota',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<style type="text/css">
    .alert{
        margin-top: -10px;
    }
</style>
        <?php echo $form->errorSummary($model); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->fileFieldRow($model,'csvFile',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->numberFieldRow($model,'consecutivos',array('class'=>'span5','maxlength'=>30)); ?>
<!--	<p class="help-block">Cantidad de cursos a activar por cada cuota.</p>-->
        
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
