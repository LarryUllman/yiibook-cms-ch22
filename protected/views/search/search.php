<?php
/*
@var $this SearchController
@var $total Integer number of hits
@var $terms String search terms
@var $hits Array hits
*/

$this->pageTitle=Yii::app()->name;

$this->renderPartial('_form', array('terms' => $terms));
?>

<?php if (!empty($terms)): ?>

<h1>Search Results</h1>

<?php echo '<h2>' . $total . ' Record(s) Found Searching for "' . $terms . '"</h2>';

foreach ($hits as $id => $hit) {

	//print_r($hit);exit;

	echo '<div><h3>' . CHtml::link($hit['title'], array('page/view', 'id'=>$id)) .'</h3>';

	// Old version for single highlight of "content":
	// echo '<p>...' . $hit['highlight'] . '...</p>';

	// New version for possible array of highlights:
	foreach ($hit['highlight'] as $field => $h) {

		echo '<p><strong>' . ucfirst($field) . '</strong>: ' . $h . '</p>';

	}

	echo '</div>';

}
?>

<?php endif; ?>