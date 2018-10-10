<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'user_id'); ?>
		<?php //echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_date'); ?>
		<?php
            //echo $form->textField($model,'order_date');
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'from_date',
                'options'=> array(
                    'dateFormat' =>'dd-mm-yy',
                    'changeMonth' => true,
                    'changeYear' => true,
                ),
                'htmlOptions'=>array('value'=>date('d-m-Y'))
            ));
        ?>
        <span class="separator">~</span>
        <?php
        //echo $form->textField($model,'order_date');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'to_date',
            'options'=> array(
                'dateFormat' =>'dd-mm-yy',
                'changeMonth' => true,
                'changeYear' => true,
            ),
            'htmlOptions'=>array('value'=>date('d-m-Y'))
        ));
        ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'total'); ?>
		<?php //echo $form->textField($model,'total'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'status'); ?>
		<?php //echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ship'); ?>
		<?php echo $form->textField($model,'user_ship',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_ship'); ?>
		<?php echo $form->textField($model,'email_ship',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address_ship'); ?>
		<?php echo $form->textField($model,'address_ship',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone_ship'); ?>
		<?php echo $form->textField($model,'phone_ship',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->