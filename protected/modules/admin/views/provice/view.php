<?php
/* @var $this ProviceController */
/* @var $model Provice */

$this->breadcrumbs=array(
	'Provices'=>array('index'),
	$model->provice_id,
);

$this->menu=array(
	array('label'=>'List Provice', 'url'=>array('index')),
	array('label'=>'Create Provice', 'url'=>array('create')),
	array('label'=>'Update Provice', 'url'=>array('update', 'id'=>$model->provice_id)),
	array('label'=>'Delete Provice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->provice_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Provice', 'url'=>array('admin')),
);
?>

<h1>View Provice #<?php echo $model->provice_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'provice_id',
		'provice_name',
	),
)); ?>
