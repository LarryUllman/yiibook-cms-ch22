<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$this->pageTitle=$model->title;

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title); ?></h1>
<p>By <?php echo $model->user->username; ?> | <?php echo CHtml::encode($model->date_published); ?></p>

<?php echo $model->content; ?>

<h3>Leave a Comment</h3>

<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
	</div>
<?php else: ?>
	<?php $this->renderPartial('/comment/_form',array(
		'model'=>$comment,
	)); ?>
<?php endif; ?>