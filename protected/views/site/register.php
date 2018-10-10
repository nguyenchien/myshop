<div class="wrap-form wrap-form-register">
    <h2 class="title">Form Register User</h2>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'register-form',
        'method' => 'post',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="row">
        <p class="label"><?php echo $model->getAttributeLabel('user_name')?><span class="required">*</span></p>
        <div class="field">
            <?php echo $form->textField($model,'user_name'); ?>
            <?php echo $form->error($model,'user_name'); ?>
        </div>
    </div>
    <div class="row">
        <p class="label"><?php echo $model->getAttributeLabel('email')?><span class="required">*</span></p>
        <div class="field">
            <?php echo $form->emailField($model,'email'); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    </div>
    <div class="row">
        <p class="label"><?php echo $model->getAttributeLabel('password')?><span class="required">*</span></p>
        <div class="field">
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
    </div>
    <div class="row">
        <p class="label"><?php echo $model->getAttributeLabel('birthday')?><span class="required">*</span></p>
        <div class="field">
            <?php
                //echo $form->textField($model,'birthday');
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'birthday',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'maxlength' => '10'
                    ),
                ));
            ?>
            <?php echo $form->error($model,'birthday'); ?>
        </div>
    </div>
    <div class="row">
        <p class="label"><?php echo $model->getAttributeLabel('phone')?><span class="required">*</span></p>
        <div class="field">
            <?php echo $form->textField($model,'phone'); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>
    </div>
    <div class="row">
        <?php
            $listGender = array("Female", "Male");
        ?>
        <p class="label"><?php echo $model->getAttributeLabel('gender')?></p>
        <div class="field"><?php echo $form->dropDownList($model,'gender', $listGender, array('empty'=>'Select Gender')); ?></div>
    </div>
    <div class="row">
        <p class="label"><?php echo $model->getAttributeLabel('address')?></p>
        <div class="field"><?php echo $form->textField($model,'address'); ?></div>
    </div>
    <div class="row">
        <?php echo CHtml::submitButton('Register', array('name'=>'register')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>