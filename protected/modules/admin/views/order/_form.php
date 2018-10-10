<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form form-order-update">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'order_id'); ?>
		<?php
            if(Yii::app()->controller->action->id == 'create'){
                echo $form->textField($model,'order_id');
            }elseif(Yii::app()->controller->action->id == 'update'){
                echo $form->textField($model,'order_id', array('disabled'=>'disabled'));
            }
        ?>
		<?php echo $form->error($model,'order_id'); ?>
	</div>

	<div class="row row-username">
		<?php echo $form->labelEx($model,'user_id'); ?>
        <?php
            if(Yii::app()->controller->action->id == 'create'){
                echo $form->textField($model,'user_id');
            }elseif(Yii::app()->controller->action->id == 'update'){
                echo "<p class='data'>";
                    if($model->user_id != 0){
                        $userInfo = Users::getUserInfo($model->user_id);
                        echo $userInfo->user_name;
                    }else{
                        echo "User Guess";
                    }
                echo "</p>";
                echo $form->hiddenField($model,'user_id');
            }
        ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ship'); ?>
		<?php echo $form->textField($model,'user_ship',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_ship'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_ship'); ?>
		<?php echo $form->textField($model,'email_ship',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_ship'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_ship'); ?>
		<?php echo $form->textField($model,'address_ship',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address_ship'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_ship'); ?>
		<?php echo $form->textField($model,'phone_ship',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'phone_ship'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->