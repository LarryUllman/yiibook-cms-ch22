<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="blog-post">
    <h2 class="blog-post-title"><?php echo CHtml::link(CHtml::encode($data->title), array('/page/view', 'id'=>$data->id)); ?></h2>
	<p class="blog-post-meta">By <?php echo $data->user->username; ?> | <?php echo CHtml::encode($data->formattedDate()); ?></p>

	<P><?php echo $data->getSnippet(); ?></p>

</div><!-- /.blog-post -->