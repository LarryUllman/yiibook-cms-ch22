<?php

class SearchController extends Controller
{

	// Search is the default action:
	public $defaultAction = 'search';

	// ElasticSearch index to use:
	private $_index = 'pages';

	// ElasticSearch type to create:
	private $_type = 'page';

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to 'search' actions
				'actions'=>array('search'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'create' and 'index' actions
				'actions'=>array('create','index'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->type) && (Yii::app()->user->type == "admin")'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// This method creates the index structure.
	public function actionCreate()
	{
		// Configure the index...
		$params = array();

		// The index is "pages":
		$params['index']  = $this->_index;

		// Configure the analysis:
		$params['body']['settings']['analysis'] = array(
			'filter' => array(
				'my_filter' => array(
					'type' => 'ngram',
					'min_gram' => 3,
					'max_gram' => 10
				)
			),
			'analyzer' => array(
				'my_analyzer' => array(
					'type' => 'custom',
					'tokenizer' => 'standard',
					'filter' => array('lowercase', 'my_filter')
				)
			)
		);

		// Map the fields:
		$params['body']['mappings']['page']  = array(
			'_source' => array(
				'enabled' => true
			),
			'properties' => array(
				'id' => array(
					'type' => 'integer',
				),
				'title' => array(
					'type' => 'string',
					'analyzer' => 'my_analyzer'
				),
				'author' => array(
					'type' => 'string',
					'analyzer' => 'my_analyzer'
				),
				'content' => array(
					'type' => 'string',
					'analyzer' => 'my_analyzer'
				)
			)
		);

		// Create the ES client:
		$client = new Elasticsearch\Client();

		// Delete the index, if need be:
		if (isset($_GET['delete'])) $client->indices()->delete(array('index' => 'pages'));

		// Create the index:
		$client->indices()->create($params);

		$this->render('create');

	} // End of actionCreate() method.

	public function actionIndex()
	{

		// Create the parameters:
		$params = array();
		$params['index'] = $this->_index;
		$params['type']  = $this->_type;

		// Create the client:
		$client = new Elasticsearch\Client();

		// Fetch the content:
		$q = 'SELECT page.id, page.title, page.content, user.username FROM page LEFT JOIN user ON page.user_id = user.id';
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query();

		// Index each row of content:
		foreach ($result as $row) {

			// Index $row.
			$params['body']  = array(
				'author'=>$row['username'],
				'title'=>$row['title'],
				'content'=> $row['content']
			);

			$params['id'] = $row['id'];
			$client->index($params);

		}
		$this->render('index');

	} // End of actionIndex() method.

	public function actionSearch()
	{

		// If no terms exist, just show the form:
		if (isset($_GET['terms'])) {
			$terms = $_GET['terms'];
		} else {
			$this->render('search', array('terms' => null));
			Yii::app()->end();
		}


		// Configure the search:
		$params = array();
		$params['index'] = $this->_index;
		$params['type']  = $this->_type;

		$params['body'] = '{
		"query": {
			"multi_match": {
				"query": "' . $terms . '",
				"fields": [
					"title^1",
					"author^1",
					"content"
					],
				"minimum_should_match": "75%"
			}
		},
		"highlight": {
			"fields": {
				"content": {
					"fragment_size": 300
				},
				"title": {
					"number_of_fragments": 0
				},
				"author": {
					"number_of_fragments": 0
				}
			}
		}
		}';

		// Create the client:
		$client = new Elasticsearch\Client();

		// Perform the search
		$results = $client->search($params);

		// Get the total:
		$total = $results['hits']['total'];

		// Get the hits:
		$hits = array();
		foreach ($results['hits']['hits'] as $hit) {
			$id = $hit['_id'];
			$hits[$id]['title'] = $hit['_source']['title'];

			// New version loops through "highlight":
			foreach ($hit['highlight'] as $field => $h) {
				$hits[$id]['highlight'][$field] = $h[0];

			}

		}

		// Render the view, passing along the stuff:
		$this->render('search', array('total' => $total, 'hits' => $hits, 'terms' => $terms));

	} // End of the actionSearch() method.

}
