<?php
//$p = array('oscar'=>array(2,3,4),'camilo'=>array(4.5,6,78,4));
//print_r($o = array_shift($p));
//echo '<br><br><br>';
//print_r($o + $p);
//exit();
?>
<table>
    <tr><td><label class="">Curso:</label></td><td>Estudiante</td></tr>
    <tr><td><?php echo CHtml::dropDownList('curso', '', CHtml::listData(MdlCourse::model()->findAll(array('order' => 'category ASC, sortorder ASC', 'condition' => 'id NOT IN(1,7,19,36,37,40,41)')), 'id', 'fullname'),array('prompt'=>'Todo','class'=>''))?></td>
        <td>    <div class="input-append">
                <input class="span4" id="buscar-estudiante" type="text">
                <button class="btn" id="estudiante" type="button">Buscar</button>
                </div>
        </td></tr>
</table>
<div id="filtro" class="span15">
<?php echo $this->renderPartial('reporteEvaluacionTbl', array('header'=>$header,'data'=>$data))?>
</div>   
<script type="text/javascript">
    var sw = false;
    $('#curso').change(function(e){
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        $.post('<?php echo Yii::app()->getBaseUrl(true); ?>/course/evaluacion',{'course':optionSelected.val(),'ajax':'ajax'},function(data){
           $('#filtro').html(data); 
        });
    });
    $('#estudiante').click(function(){
        if(!sw){
            sw = true;
        $.post('<?php echo Yii::app()->getBaseUrl(true); ?>/course/evaluacion',{'ValEstudiante':$('#buscar-estudiante').val(),'ajax':'ajax'},function(data){
           $('#filtro').html(data); 
           sw = false;
        });
    }
    });
</script>