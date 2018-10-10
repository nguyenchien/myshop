<?php
/* @var $this CategoryController */
/* @var $data Category */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cate_id), array('view', 'id'=>$data->cate_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_name')); ?>:</b>
	<?php echo CHtml::encode($data->cate_name); ?>
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