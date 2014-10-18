<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => new CActiveDataProvider('Page',
		array(
			'criteria' => array(
				'condition' => 'live=1',
				'order' => 'date_published DESC'
				),
			'pagination' => array(
				'pageSize'=>3
			)
		)
	),
	'itemView'=>'/page/_view',
	'template'=>'{items}{pager}'
)); ?>
