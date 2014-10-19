<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

  <div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

  <div class="form-group">
		<?php echo $form->labelEx($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'pass'); ?>
	</div>

		<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-default')); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
