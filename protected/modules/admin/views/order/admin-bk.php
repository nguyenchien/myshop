<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Create Order', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'order_id',
		array(
            'header'=>'Order User',
            'name'=>'user_id',
            'type'=>'raw',
            'value'=> function($data){
                if($data->user_id != 0){
                    $userInfo = Users::getUserInfo($data->user_id);
                    return $userInfo->user_name;
                }else{
                    return "User Guess";
                }
            }
        ),
		'order_date',
		array(
            'header'=>'Total',
            'name' => 'total',
            'type' => 'raw',
            'value' => function($data){
                return number_format($data->total) . ' VNĐ';
            }
        ),
		'status',
		array(
            'header'=>'User Ship',
            'name' => 'user_ship',
            'type' => 'raw',
            'value' => function($data){
                if($data->user_id != 0){
                    $userInfo = Users::getUserInfo($data->user_id);
                    return $userInfo->user_name;
                }else{
                    return $data->user_ship;
                }
            }
        ),
        array(
            'header'=>'Email Ship',
            'name' => 'email_ship',
            'type' => 'raw',
            'value' => function($data){
                if($data->user_id != 0){
                    $userInfo = Users::getUserInfo($data->user_id);
                    return $userInfo->email;
                }else{
                    return $data->email_ship;
                }
            }
        ),
        array(
            'header'=>'Address Ship',
            'name' => 'address_ship',
            'type' => 'raw',
            'value' => function($data){
                if($data->user_id != 0){
                    $userInfo = Users::getUserInfo($data->user_id);
                    return $userInfo->address;
                }else{
                    return $data->address_ship;
                }
            }
        ),
        array(
            'header'=>'Phone Ship',
            'name' => 'phone_ship',
            'type' => 'raw',
            'value' => function($data){
                if($data->user_id != 0){
                    $userInfo = Users::getUserInfo($data->user_id);
                    return $userInfo->phone;
                }else{
                    return $data->phone_ship;
                }
            }
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
