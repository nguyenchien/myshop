<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cate_id'); ?>
		<?php echo $form->textField($model,'cate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_name'); ?>
		<?php echo $form->textField($model,'cate_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_create'); ?>
		<?php echo $form->textField($model,'date_create'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'date_modified'); ?>
        <?php echo $form->textField($model,'date_modified'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->