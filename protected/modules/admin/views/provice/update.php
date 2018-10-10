<?php
/* @var $this ProviceController */
/* @var $model Provice */

$this->breadcrumbs=array(
	'Provices'=>array('index'),
	$model->provice_id=>array('view','id'=>$model->provice_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Provice', 'url'=>array('index')),
	array('label'=>'Create Provice', 'url'=>array('create')),
	array('label'=>'View Provice', 'url'=>array('view', 'id'=>$model->provice_id)),
	array('label'=>'Manage Provice', 'url'=>array('admin')),
);
?>

<h1>Update Provice <?php echo $model->provice_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>