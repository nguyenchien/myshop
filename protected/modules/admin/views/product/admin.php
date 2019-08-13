<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Products</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pro_id',
		array(
            'header'=>'Name',
            'name' => 'pro_name',
            'type' => 'raw',
            'value' => function($data){
                return CHtml::link($data->pro_name, BASE_URL."/product/detail/".$data->pro_id, array("target"=>"_blank"));
            }
        ),
        array(
            'header'=>'Category',
            'name' => 'cate_id',
            'type' => 'raw',
            'value' => function($data){
                $cateName = Category::getCateName($data->cate_id);
                return CHtml::link($cateName->cate_name, BASE_URL."/product/list/".$data->cate_id, array("target"=>"_blank"));
            }
        ),
        array(
            'header'=>'Price',
            'name' => 'price',
            'type' => 'raw',
            'value' => function($data){
                return number_format($data->price) . " VNĐ";
            }
        ),
        array(
            'header'=>'Image',
            'name' => 'image',
            'type' => 'raw',
            'value' => function($data){
                return CHtml::image(Yii::app()->getBaseUrl(true).$data->image, 'Laptop '.$data->pro_name, array(
                    'title' => 'Laptop '.$data->pro_name,
                    'width' => "100px"
                ));
            }
        ),
//		'image_2',
//		'image_3',
//		'description',
//		'meta_key',
//		'meta_description',
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
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
