<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'action'=>$this->createUrl('site/login'),
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
        ),
    'htmlOptions'=>array(
        'class'=>'well',
        ),
)); ?>


<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3'));
 ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3'));
  ?>
<br/>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login')); ?>
 
<?php $this->endWidget(); ?>


