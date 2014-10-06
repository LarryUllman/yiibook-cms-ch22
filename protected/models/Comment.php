<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property string $page_id
 * @property string $username
 * @property string $user_email
 * @property string $comment
 * @property string $date_entered
 *
 * The followings are the available model relations:
 * @property Page $page
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// Required attributes (by the user):
			array('username, user_email, comment', 'required'),

			// Must be in related tables:
			array('page_id', 'exist'),

			// Strip tags from the comments:
			array('comment', 'filter', 'filter'=>'strip_tags'),

			// Set the date_entered to NOW():
			array('date_entered', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),

			// Username limited to 45:
			array('username', 'length', 'max'=>45),

			// Email limited to 60 and must be an email address:
			array('user_email', 'length', 'max'=>60),
			array('user_email', 'email'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('page_id, username, user_email, comment, date_entered', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'page_id' => 'Page',
			'username' => 'Username',
			'user_email' => 'User Email',
			'comment' => 'Comment',
			'date_entered' => 'Date Entered',
		);
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
		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('date_entered',$this->date_entered,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
