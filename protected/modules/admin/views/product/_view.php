<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pro_id), array('view', 'id'=>$data->pro_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_name')); ?>:</b>
	<?php echo CHtml::encode($data->pro_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_id')); ?>:</b>
	<?php echo CHtml::encode($data->cate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php
        //echo CHtml::encode($data->image);
        echo CHtml::image(Yii::app()->getBaseUrl(true).$data->image, 'Laptop '.$data->pro_name, array('width'=>'100px'));
    ?>

	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image_2')); ?>:</b>
	<?php
        //echo CHtml::encode($data->image_2);
        echo CHtml::image(Yii::app()->getBaseUrl(true).$data->image_2, 'Laptop '.$data->pro_name, array('width'=>'100px'));
    ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image_3')); ?>:</b>
	<?php
        //echo CHtml::encode($data->image_3);
        echo CHtml::image(Yii::app()->getBaseUrl(true).$data->image_3, 'Laptop '.$data->pro_name, array('width'=>'100px'));
    ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_key')); ?>:</b>
	<?php echo CHtml::encode($data->meta_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_description')); ?>:</b>
	<?php echo CHtml::encode($data->meta_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_modified')); ?>:</b>
    <?php echo CHtml::encode($data->date_modified); ?>
    <br />
</div>