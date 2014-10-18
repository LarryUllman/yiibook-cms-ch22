<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $id
 * @property string $user_id
 * @property integer $live
 * @property string $title
 * @property string $content
 * @property string $date_updated
 * @property string $date_published
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $user
 */
class Page extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// Only the title is required from the user:
			array('title', 'required'),

			// User must exist in the related table:
			array('user_id', 'exist', 'attributeName'=>'id', 'className'=>'User', 'message'=>'The specified author does not exist.'),

			// Live needs to be Boolean; default 0:
			array('live', 'boolean'),
			array('live', 'default', 'value'=>0),

			// Title has a max length and strip tags:
			array('title', 'length', 'max'=>100),
			array('title', 'filter', 'filter'=>'strip_tags'),

			// Filter the content to allow for NULL values:
			array('content', 'default', 'value'=>NULL),

			// Set the date_updated to NOW() every time:
			array('date_updated', 'default', 'value'=>new CDbExpression('NOW()')),

			// date_published must be in a format that MySQL likes:
//			array('date_published', 'date', 'format'=>'YYYY-MM-DD'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, live, title, content, date_updated, date_published', 'safe', 'on'=>'search'),
		);
	}


	// Set the user_id value to the current user, if it's not empty:
	protected function beforeValidate() {
		if(empty($this->user_id)) {
			$this->user_id = Yii::app()->user->id;
		}
		return parent::beforeValidate();
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'page_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),

			// commentCount stolen from Yii blog example:
			'commentCount' => array(self::STAT, 'Comment', 'page_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Author',
			'live' => 'Live',
			'title' => 'Title',
			'content' => 'Content',
			'date_updated' => 'Date Updated',
			'date_published' => 'Date Published',
		);
	}

	public function getSnippet()
	{
		return substr($this->content, 0, strpos($this->content, '.'));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('live',$this->live);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('date_published',$this->date_published,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
