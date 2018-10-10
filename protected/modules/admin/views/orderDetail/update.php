<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->order_detail_id=>array('view','id'=>$model->order_detail_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetail', 'url'=>array('index')),
	array('label'=>'Create OrderDetail', 'url'=>array('create')),
	array('label'=>'View OrderDetail', 'url'=>array('view', 'id'=>$model->order_detail_id)),
	array('label'=>'Manage OrderDetail', 'url'=>array('admin')),
);
?>

<h1>Update OrderDetail <?php echo $model->order_detail_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>