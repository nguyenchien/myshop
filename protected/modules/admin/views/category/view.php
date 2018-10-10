<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->cate_id,
);

$this->menu=array(
	//array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->cate_id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cate_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>View Category #<?php echo $model->cate_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cate_id',
		'cate_name',
		'status',
        array(
            'header'=>'Date Create',
            'name' => 'date_create',
            'type' => 'raw',
            'value' => function($data){
                $date = new DateTime($data->date_create);
                return $date->format('d-m-Y H:i:s');
            }
        ),
        array(
            'header'=>'Date Modified',
            'name' => 'date_modified',
            'type' => 'raw',
            'value' => function($data){
                if($data->date_modified != ''){
                    $date = new DateTime($data->date_modified);
                    return $date->format('d-m-Y H:i:s');
                }
            }
        ),
	),
)); ?>
