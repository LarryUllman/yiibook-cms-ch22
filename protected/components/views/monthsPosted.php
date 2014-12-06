<div class="sidebar-module">
<h4>Archives</h4>
<ol class="list-unstyled">
	<?php foreach ($data as $item) {
		echo '<li>' . CHtml::link($item['l'], array('/page/archives', 'year'=>$item['y'], 'month'=>$item['m'])) . '</li>';
	}
	?>
</ol>
</div>
