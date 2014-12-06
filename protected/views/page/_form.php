<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

  <div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'content'); ?>
		<?php
	Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
		$this->widget('ImperaviRedactorWidget', array(
		    'selector' => '#Page_content',
		    // Some options, see http://imperavi.com/redactor/docs/
		    'options' => array(
		    ),
		)); ?>
	</div>

  <div class="form-group">
		<?php echo $form->labelEx($model,'date_published'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => 'date_published',
		    'htmlOptions' => array(
		        'size' => '10',         // textField size
		        'maxlength' => '10',    // textField maxlength
		        'class' => 'form-control'
		    ),
		    'options' => array(
		    	'dateFormat' => 'yy-mm-dd',
		    	'showOtherMonths' => true,
		    	'selectOtherMonths' => true,
		    	'changeYear' => true,
		    	'changeMonth' => true
		    )
		));
		?>
		<?php echo $form->error($model,'date_published'); ?>
	</div>

  <div class="form-group">
		<?php echo $form->labelEx($model,'live'); ?>
		<?php echo $form->checkBox($model,'live', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'live'); ?>
	</div>

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-default')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
