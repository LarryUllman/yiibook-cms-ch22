<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pages',
);

$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
?>

<h1>Posts from <?php echo $months[$month] . ' ' . $year; ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
