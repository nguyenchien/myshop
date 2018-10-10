<?php
/* @var $this ProviceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Provices',
);

$this->menu=array(
	array('label'=>'Create Provice', 'url'=>array('create')),
	array('label'=>'Manage Provice', 'url'=>array('admin')),
);
?>

<h1>Provices</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
