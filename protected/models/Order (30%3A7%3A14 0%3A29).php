<?php

/**
 * This is the model class for table "Order".
 *
 * The followings are the available columns in table 'Order':
 * @property string $order_id
 * @property string $order_number
 * @property string $member_id
 * @property string $order_status
 * @property string $order_status_internal
 * @property string $shipment_method
 * @property string $self_pickup_location
 * @property string $verification_code
 * @property string $shipment_cost
 * @property string $shipment_cost_currency
 * @property string $title
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $postal_code
 * @property string $country_code
 * @property string $country
 * @property string $remarks
 * @property string $remarks_internal
 * @property string $total_order_price
 * @property string $total_order_price_currency
 * @property string $order_created_date
 * @property string $last_order_status_update
 *
 * The followings are the available model relations:
 * @property Member $member
 * @property CountryCode $countryCode
 * @property OrderItem[] $orderItems
 * @property OrderReference[] $orderReferences
 * @property PaypalOrder[] $paypalOrders
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $other_country;
	public $destination;
	public function tableName()
	{
		return 'Order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, title, phone, address', 'required','message'=>'{attribute} 不能留空'),
			array('order_created_date, last_order_status_update, country_code, country', 'safe'),
			array('phone', 'match', 'pattern'=>'/^[0-9]+$/', 'message'=>"請再次輸入"),
			//array('country_code', 'for_country'),
			//array('country', 'for_country'),
			array('member_id', 'length', 'max'=>11),
			array('order_status, order_status_internal', 'length', 'max'=>25),
			array('order_number, shipment_cost, total_order_price', 'length', 'max'=>10),
			array('verification_code', 'length', 'max'=>25),
			array('shipment_cost_currency, total_order_price_currency', 'length', 'max'=>3),
			array('title, phone, postal_code', 'length', 'max'=>20),
			array('name, address, other_country', 'length', 'max'=>255),
			array('country_code', 'length', 'max'=>2),
			array('remarks, remarks_internal,member_id, shipment_method, shipment_cost_currency , total_order_price_currency, other_country,destination,self_pickup_location', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_id, member_id, order_status, order_status_internal, shipment_method, shipment_cost, shipment_cost_currency, title, name, phone, address, postal_code, country_code, remarks, remarks_internal, total_order_price, total_order_price_currency, order_created_date, last_order_status_update', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
			'countryCode' => array(self::BELONGS_TO, 'CountryCode', 'country_code'),
			'orderItems' => array(self::HAS_MANY, 'OrderItem', 'order_id'),
			'orderReferences' => array(self::HAS_MANY, 'OrderReference', 'order_id'),
			'paypalOrders' => array(self::HAS_MANY, 'PaypalOrder', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'order_number' => 'Order Number',
			'member_id' => 'Member',
			'order_status' => 'Order Status',
			'order_status_internal' => 'Order Status Internal',
			'shipment_method' => 'Shipment Method',
			'shipment_cost' => 'Shipment Cost',
			'self_pickup_location' => 'Self Pickup Location',
			'verification_code' => 'Verification Code',
			'shipment_cost_currency' => 'Shipment Cost Currency',
			'title' => '稱謂',
			'name' => '收貨人',
			'phone' => '電話',
			'address' => '配送地址',
			'postal_code' => '郵區編號',
			'country_code' => '國家/地區',
			'country'=>'其他國家',
			'remarks' => '備註留言',
			'remarks_internal' => 'Remarks Internal',
			'total_order_price' => 'Total Order Price',
			'total_order_price_currency' => 'Total Order Price Currency',
			'order_created_date' => 'Order Created Date',
			'last_order_status_update' => 'Last Order Status Update',
			'other_country'=>'其他國家',
			'destination'=>'destination',
			//'shipment_method'=>'shipment_method'
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
		$criteria->compare('order_number',$this->order_number,true);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('order_status',$this->order_status,true);
		$criteria->compare('order_status_internal',$this->order_status_internal,true);
		$criteria->compare('shipment_method',$this->shipment_method,true);
		$criteria->compare('self_pickup_location',$this->self_pickup_location,true);
		$criteria->compare('verification_code',$this->verification_code,true);
		$criteria->compare('shipment_cost',$this->shipment_cost,true);
		$criteria->compare('shipment_cost_currency',$this->shipment_cost_currency,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('remarks_internal',$this->remarks_internal,true);
		$criteria->compare('total_order_price',$this->total_order_price,true);
		$criteria->compare('total_order_price_currency',$this->total_order_price_currency,true);
		$criteria->compare('order_created_date',$this->order_created_date,true);
		$criteria->compare('last_order_status_update',$this->last_order_status_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
 /*public function for_country($attribute,$params)
   {

    if($this->country_code){
     if(empty($this->country))
         $this->addError('country','Error Message');
  }   
 }*/
}
