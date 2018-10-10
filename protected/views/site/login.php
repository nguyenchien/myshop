<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */
?>
<div class="wrap-form wrap-form-login">
    <h2 class="title">Login</h2>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
        <div class="row">
            <?php echo $form->labelEx($model,'username', array('class'=>'label')); ?>
            <div class="field">
                <?php echo $form->textField($model,'username'); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'password', array('class'=>'label')); ?>
            <div class="field">
                <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>
        </div>
        <div class="row">
            <?php echo CHtml::submitButton('Login'); ?>
        </div>
    <?php $this->endWidget(); ?>
</div>