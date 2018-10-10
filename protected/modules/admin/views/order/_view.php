<?php
/* @var $this OrderController */
/* @var $data Order */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->order_id), array('view', 'id'=>$data->order_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_date')); ?>:</b>
	<?php echo CHtml::encode($data->order_date); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
    <?php echo CHtml::encode($data->modified_date); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_ship')); ?>:</b>
	<?php echo CHtml::encode($data->user_ship); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_ship')); ?>:</b>
	<?php echo CHtml::encode($data->email_ship); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address_ship')); ?>:</b>
	<?php echo CHtml::encode($data->address_ship); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_ship')); ?>:</b>
	<?php echo CHtml::encode($data->phone_ship); ?>
	<br />

	*/ ?>

</div>