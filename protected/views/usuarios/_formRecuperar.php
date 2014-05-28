<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'usuarios-form-recuperar',
    'action' => $this->createUrl('usuarios/recuperarPassword'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'beforeValidate' => 'js:funrecuperarPassword',
    ),
    'htmlOptions' => array(
        'class' => 'well',
    ),
        ));
?>

<?php echo $form->textFieldRow($modelRegistro, 'correo', array('class' => 'span3')); ?>

<?php echo CHtml::activeLabel($modelRegistro, 'validacion'); ?>
<?php
$this->widget('ext.recaptcha.EReCaptcha', array(
    'model' => $modelRegistro,
    'attribute' => 'validacion',
    'theme' => 'red', 'language' => 'es_ES',
    'publicKey' => '6LfyGPESAAAAAKbLfsQOkRIdQGiKhGBKBBhgAIzr',
    'htmlOptions' => array(
        'class' => 'span3'
)))
?>
<?php echo $form->error($modelRegistro, 'validacion', array('id' => 'Usuarios_validacion_em_')); ?>


<?php
echo"<br>";
$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Enviar'));

$this->endWidget();
?>

<script type="text/javascript">
    var submit = false;
    function funrecuperarPassword()
    {
        if (!submit) {
            data = $('#usuarios-form-recuperar').serialize() + '&ajax=usuarios-form-recuperar';
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo Yii::app()->getBaseUrl(true); ?>/usuarios/recuperarPassword",
                data: data,
                success: function(data) {
                    console.log(data);
                    sw = true;
                    for (x in data)
                    {
                        sw = false;
                        $('#usuarios-form-recuperar #' + x + '_em_').css('display', 'block');
                        $('#usuarios-form-recuperar #' + x + '_em_').html(data[x][0]);
                    }
                    if (sw)
                    {
                        submit = true;
                        $('#usuarios-form-recuperar').submit();
                    }else{
                        document.getElementById('recaptcha_reload_btn').click();
                    }
                }
            });
            return false;
        } else {
            return true;
        }
    }
</script>