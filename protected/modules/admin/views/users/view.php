<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
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
	),
)); ?>
