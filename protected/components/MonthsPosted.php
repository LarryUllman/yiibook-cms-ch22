<?php

Yii::import('zii.widgets.CPortlet');

class MonthsPosted extends CPortlet
{
	protected function renderContent()
	{
		$q = "SELECT DISTINCT(CONCAT(MONTHNAME(date_published), ' ', YEAR(date_published))) AS l, MONTH(date_published) AS m, YEAR(date_published) AS y FROM page WHERE live=1 ORDER BY y DESC, m DESC";
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query();
		$this->render('monthsPosted', array('data' => $result));
	}
}