<?php
/* @var $this ProviceController */
/* @var $model Provice */

$this->breadcrumbs=array(
	'Provices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Provice', 'url'=>array('index')),
	array('label'=>'Manage Provice', 'url'=>array('admin')),
);
?>

<h1>Create Provice</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>