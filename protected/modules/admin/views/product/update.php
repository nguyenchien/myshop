<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
    'Products'=>array('index'),
    $model->pro_id=>array('view','id'=>$model->pro_id),
    'Update',
    );

    $this->menu=array(
    //array('label'=>'List Product', 'url'=>array('index')),
    array('label'=>'Create Product', 'url'=>array('create')),
    array('label'=>'View Product', 'url'=>array('view', 'id'=>$model->pro_id)),
    array('label'=>'Manage Product', 'url'=>array('admin')),
    );
    ?>

    <h1>Update Product <?php echo $model->pro_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'data'=>$data)); ?>