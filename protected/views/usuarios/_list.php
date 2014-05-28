<?php
$criteria = new CDbCriteria();
$criteria->alias = 'usuario';
$criteria->with = array(
    'perfiles' => array(
        'alias' => 'perfil',
    ),
);
//$criteria->params = array('3');
$dataProvider = new CActiveDataProvider('Usuarios', array(
    'criteria' => $criteria,
    'pagination' => array(
        'pageSize' => 20,
    )
        )
);
?>

<form class="form-search buscador" id="buscador-titulo-usuario" >
    <div class="input-append">
        <input type="text" id="texto-filtro-usuario" class="span6 search-query btn-large" placeholder="Buscar campos" style="padding: 11px 19px;font-size: 17.5px;">
        <button type="submit" class="btn btn-large">
            <i class="icon-search"></i>
            Buscar
        </button>
    </div>
</form>
<?php 

$model = new Usuarios();
// Working with selector
$campos = array('nombre' => 'Nombre','apellido1' => 'Apellido','correo'=>'Correo',  'perfil' => 'Perfil');
$modUsuario = new Usuarios();
$this->widget('ext.select2.ESelect2',array(
  'id'=>'campos',
  'name'=>'campos',
  'data'=>$campos,
  'options' => array(
      'width'=>'200',
      'placeholder' => 'Columna'
  ),
  'htmlOptions'=>array(
    'multiple'=>'multiple',
  ),
));
?>

<div class="form-actions">
    <form action="<?php echo Yii::app()->createUrl('usuarios/create');?>" method="POST">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'label'=>'Nuevo',
		)); ?>
    </form>     
</div>

<div id="grid-lista-programas">
<?php

$this->renderPartial('_gridUsuarios', array('dataProvider' => $dataProvider));

?>



</div>

<script type="text/javascript">

    $(document).on('submit', '#buscador-titulo-usuario', cargarFiltro);

    function cargarFiltro(e)
    {
        if ($('#texto-filtro-usuario').val() != '')
        {
            array = $('#campos').select2("data");
            $.ajax({
                type: 'post',
                data: 'data=' + $('#texto-filtro-usuario').val()+'&columnas='+JSON.stringify(array),
                url: '<?php echo Yii::app()->createUrl('usuarios/ajaxFiltroUsuarios') ?>',
                success: function(r) {
                    $('#grid-lista-programas').html(r);
                },
                error: function(r) {
                    console.log(r);
                }
            });
        }
        e.preventDefault();
    }
</script>

