<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->order_detail_id,
);

$this->menu=array(
	array('label'=>'List OrderDetail', 'url'=>array('index')),
	array('label'=>'Create OrderDetail', 'url'=>array('create')),
	array('label'=>'Update OrderDetail', 'url'=>array('update', 'id'=>$model->order_detail_id)),
	array('label'=>'Delete OrderDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_detail_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderDetail', 'url'=>array('admin')),
);
?>

<h1>View OrderDetail #<?php echo $model->order_detail_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_detail_id',
		'order_id',
		'pro_id',
		'price',
		'date_create',
		'quality',
	),
)); ?>
