<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'subir-cuota',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
<p class="help-block">Los cursos que no sean diligenciados en su proridad, se asume que no se trendran en cuenta.</p>

<?php echo $form->errorSummary($model); ?>
<div class="span10">
<table class="table table-bordered table-hover">
        <thead>
            <th>Curso</th><th>Descripcion corta</th><th>Prioridad</th>
        </thead>
        <tbody>
            <?php foreach ($cursos as $curso) {
                
            ?>
            <tr>
                <td><label class="" for="Curso_Consecutivo_<?php echo $curso->id; ?>"><?php echo $curso->fullname; ?></label></td>
                <td><label class="" for="Curso_Consecutivo_<?php echo $curso->id; ?>"><?php echo $curso->shortname; ?></label></td>
                <td><input type="text" id="Curso_Consecutivo_<?php echo $curso->id; ?>" name="Curso_Consecutivo[<?php echo $curso->id;?>]" maxlength="30" class="span3" value="<?php echo isset($curso->complemento->prioridad)?$curso->complemento->prioridad:''; ?>"></td>                
            </tr>
            <?php 
                   }
                   ?>
            </tbody>
        </table>
</div>    

<div class="form-actions span10">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Guardar',
    ));
    ?>
</div>


<?php $this->endWidget(); ?>
