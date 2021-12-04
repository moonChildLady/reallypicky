<?php

/**
 * This is the model class for table "PaypalOrder".
 *
 * The followings are the available columns in table 'PaypalOrder':
 * @property string $order_id
 * @property string $token
 * @property string $transation_id
 * @property string $transation_date
 * @property string $amount
 * @property string $fee_amount
 * @property string $currency
 * @property string $payment_status
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Order $order
 */
class PaypalOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PaypalOrder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id', 'required'),
			array('order_id, amount, fee_amount', 'length', 'max'=>10),
			array('token, transation_id', 'length', 'max'=>50),
			array('currency', 'length', 'max'=>5),
			array('payment_status', 'length', 'max'=>25),
			array('transation_date, create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_id, token, transation_id, transation_date, amount, fee_amount, currency, payment_status, create_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'token' => 'Token',
			'transation_id' => 'Transation',
			'transation_date' => 'Transation Date',
			'amount' => 'Amount',
			'fee_amount' => 'Fee Amount',
			'currency' => 'Currency',
			'payment_status' => 'Payment Status',
			'create_date' => 'Create Date',
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

		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('transation_id',$this->transation_id,true);
		$criteria->compare('transation_date',$this->transation_date,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('fee_amount',$this->fee_amount,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaypalOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
