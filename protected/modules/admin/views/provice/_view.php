<?php
/* @var $this ProviceController */
/* @var $data Provice */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('provice_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->provice_id), array('view', 'id'=>$data->provice_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provice_name')); ?>:</b>
	<?php echo CHtml::encode($data->provice_name); ?>
	<br />


</div>