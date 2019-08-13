<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=> array(
        'enctype' => 'multipart/form-data'
    )
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pro_name'); ?>
		<?php echo $form->textField($model,'pro_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pro_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cate_id'); ?>
		<?php echo $form->dropDownList($model,'cate_id', $data, array('empty'=>'Select a cate')); ?>
		<?php echo $form->error($model,'cate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
        <?php if($model->image): ?>
            <span class="image"><img src="<?= BASE_URL . $model->image; ?>" width="100" alt=""></span>
        <?php endif; ?>
		<?php //echo $form->fileField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::fileField('Product[image]', $model->image, array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'image_2'); ?>
        <?php if($model->image_2): ?>
            <span class="image"><img src="<?= BASE_URL . $model->image_2; ?>" width="100" alt=""></span>
        <?php endif; ?>
        <?php //echo $form->fileField($model,'image_2',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::fileField('Product[image_2]', $model->image_2, array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'image_2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'image_3'); ?>
        <?php if($model->image_3): ?>
            <span class="image"><img src="<?= BASE_URL . $model->image_3; ?>" width="100" alt=""></span>
        <?php endif; ?>
        <?php //echo $form->fileField($model,'image_3',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo CHtml::fileField('Product[image_3]', $model->image_3, array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'image_3'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
            echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50));
            /*$this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'description'
            ));*/
        ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_key'); ?>
		<?php echo $form->textArea($model,'meta_key',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'meta_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->