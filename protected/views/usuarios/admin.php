<?php
$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Usuarios','url'=>array('index')),
	array('label'=>'Nuevo Usuario','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuarios-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usuarioses</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_usuario',
		'state_usuario',
		'nombre',
		'apellido1',
		'apellido2',
		'contrasena',
		/*
		'telefono',
		'celular',
		'correo',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
