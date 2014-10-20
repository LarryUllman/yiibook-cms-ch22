<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Create',
);
?>

<h1>Create Comment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>