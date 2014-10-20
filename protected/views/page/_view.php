<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="blog-post">
    <h3 class="blog-post-title"><?php echo CHtml::link(CHtml::encode($data->title), array('/page/view', 'id'=>$data->id, 'title'=>$data->title)); ?></h3>
	<p class="blog-post-meta">By <?php echo $data->user->username; ?> | <?php echo CHtml::encode($data->formattedDate()); ?></p>

	<P><?php echo $data->getSnippet(); ?></p>

</div><!-- /.blog-post -->