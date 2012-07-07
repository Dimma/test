<?php

class Messages extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_chat':
	 * @var	integer	$id
	 * @var	string	$content
	 * @var	integer	$create_time
	 * @var	string	$author
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @access	public
	 * @return	CActiveRecord the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Get table name
	 * @access	public
	 * @return	string	the associated database table name
	 */
	public function tableName()
	{
		return '{{chat}}';
	}

	/**
	 * Rules
	 * @access	public
	 * @return	array	validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, author, create_time', 'required'),
			array('content', 'length', 'max' => 100),
		);
	}

	/**
	 * Labels of atributes
	 * @access	public
	 * @return	array	customized attribute labels (name => label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'			=> 'Id',
			'content'		=> 'Message',
			'create_time'	=> 'Create Time',
			'author'		=> 'Username',
		);
	}

	/**
	 * Get messages
	 * @access	public
	 * @param	integer	the maximum number of messages that should be returned
	 * @return	array
	 */
	public function getMessages($limit = 15)
	{
		return array_reverse($this->findAll(array(
			'order'		=> 't.create_time DESC',
			'limit'		=> $limit,
		)));
	}

	/**
	 * Insert message
	 * @access	public
	 * @param	string	$message
	 */
	public function addMessage($message)
	{
		$isUserLoggedOn	= CHtml::encode(Yii::app()->user->name) && !Yii::app()->user->isGuest;
		$command		= Yii::app()->db->createCommand();
		$command->insert('tbl_chat', array(
			'author'		=> ($isUserLoggedOn ? CHtml::encode(Yii::app()->user->name) : 'Guest'),
			'content'		=> $message,
			'create_time'	=> time(),
		));
	}
}