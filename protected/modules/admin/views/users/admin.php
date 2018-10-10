<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

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
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_id',
		'user_name',
		'email',
		'password',
        array(
            'header'=>'Birthday',
            'name' => 'birthday',
            'type' => 'raw',
            'value' => function($data){
                $date = new DateTime($data->birthday);
                return $date->format('d-m-Y');
            }
        ),
		'phone',
        'address',
        array(
            'header'=>'Gender',
            'name' => 'gender',
            'type' => 'raw',
            'value' => function($data){
                return ($data->gender == 1) ? 'Nam' : 'Nữ';
            }
        ),
		'province_id',
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
			'class'=>'CButtonColumn',
		),
	),
)); ?>
