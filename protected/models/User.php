<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $pass
 * @property string $type
 * @property string $date_entered
 *
 * The followings are the available model relations:
 * @property Page[] $pages
 */
class User extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			// Required fields when registering:
			array('username, email, pass', 'required', 'on'=>'insert'),

			// Required fields when registering:
			array('username, email, pass', 'required', 'on'=>'insert'),

			// Username must be unique and less than 45 characters:
			array('email, username', 'unique'),
			array('username', 'length', 'max'=>45),

			// Email address must also be unique (see above), an email address, and less than 60 characters:
			array('email', 'email'),
			array('email', 'length', 'max'=>60),

			// Set the type to "author" by default:
			array('type', 'default', 'value'=>'author'),

			// Type must also be one of three values:
			array('type', 'in', 'range'=>array('author', 'editor', 'admin')),

			// Set the date_entered to NOW():
			array('date_entered', 'default', 'value'=>new CDbExpression('NOW()'),
				'on'=>'insert'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('username, email, type, date_entered', 'safe', 'on'=>'search'),
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
			'pages' => array(self::HAS_MANY, 'Page', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'pass' => 'Password',
			'type' => 'Type',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('date_entered',$this->date_entered,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
