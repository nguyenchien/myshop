<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->pro_id,
);

$this->menu=array(
	//array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->pro_id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pro_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->pro_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pro_id',
		'pro_name',
		'cate_id',
		'price',
        array(
            'name' => 'image',
            'type' => 'raw',
            'value' => function($data){
                return CHtml::image(Yii::app()->getBaseUrl(true).$data->image, 'Laptop '.$data->pro_name, array('title' => 'Laptop '.$data->pro_name,'width' => "50px"));
            }
        ),
		'image_2',
		'image_3',
		'description',
		'meta_key',
		'meta_description',
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
