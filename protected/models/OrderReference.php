<?php

/**
 * This is the model class for table "OrderReference".
 *
 * The followings are the available columns in table 'OrderReference':
 * @property string $token
 * @property string $product_id
 * @property string $member_id
 * @property string $order_id
 * @property string $create_date
 * @property string $last_modified_date
 *
 * The followings are the available model relations:
 * @property Order $order
 * @property Product $product
 * @property Member $member
 */
class OrderReference extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'OrderReference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, member_id, order_id, create_date, last_modified_date', 'required'),
			array('token', 'length', 'max'=>50),
			array('product_id, member_id, order_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('token, product_id, member_id, order_id, create_date, last_modified_date', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'token' => 'Token',
			'product_id' => 'Product',
			'member_id' => 'Member',
			'order_id' => 'Order',
			'create_date' => 'Create Date',
			'last_modified_date' => 'Last Modified Date',
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

		$criteria->compare('token',$this->token,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('last_modified_date',$this->last_modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderReference the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
