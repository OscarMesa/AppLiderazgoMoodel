<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'completar-usuarios',
	'enableAjaxValidation'=>false,
        'action' => Yii::app()->getBaseUrl(true).'/usuarios/completarInfoUsuarios',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

        <?php
        if(count($errors)>0){
        ?>
            <div class="alert alert-block alert-error"><p>Por favor corrija los siguientes errores:</p>
                <ul>
                    <?php 
                        foreach($errors as $key => $error) {
                            echo '<li>'.$error.'</li>';
                        }
                    ?>
                </ul>
            </div>
        <?php }?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

        <label for="txtFileMigra" class="required">Archivo txt de subida<span class="required">*</span></label>
        
        <input class="span5" name="txtFileMigra" id="txtFileMigra" type="file">
<!--	<p class="help-block">Cantidad de cursos a activar por cada cuota.</p>-->
        
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
