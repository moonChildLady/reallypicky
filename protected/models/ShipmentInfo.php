<?php

/**
 * This is the model class for table "ShipmentInfo".
 *
 * The followings are the available columns in table 'ShipmentInfo':
 * @property string $id
 * @property string $comp_id
 * @property string $destination_country_codes
 * @property string $destination_name
 * @property string $shipment_method
 * @property integer $est_shipment_days
 * @property integer $est_shipment_days_from
 * @property integer $est_shipment_days_to
 * @property string $shipment_cost1
 * @property string $shipment_order_price1
 * @property string $shipment_order_price_currency_1
 * @property string $shipment_cost2
 * @property string $shipment_order_price2
 * @property string $shipment_order_price_currency_2
 *
 * The followings are the available model relations:
 * @property Company $comp
 */
class ShipmentInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ShipmentInfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_id, destination_country_codes, destination_name, est_shipment_days, est_shipment_days_from, est_shipment_days_to, shipment_order_price_currency_1, shipment_cost2, shipment_order_price2, shipment_order_price_currency_2', 'required'),
			array('est_shipment_days, est_shipment_days_from, est_shipment_days_to', 'numerical', 'integerOnly'=>true),
			array('comp_id', 'length', 'max'=>11),
			array('destination_name, shipment_method', 'length', 'max'=>50),
			array('shipment_cost1, shipment_order_price1, shipment_cost2, shipment_order_price2', 'length', 'max'=>10),
			array('shipment_order_price_currency_1, shipment_order_price_currency_2', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, comp_id, destination_country_codes, destination_name, shipment_method, est_shipment_days, est_shipment_days_from, est_shipment_days_to, shipment_cost1, shipment_order_price1, shipment_order_price_currency_1, shipment_cost2, shipment_order_price2, shipment_order_price_currency_2', 'safe', 'on'=>'search'),
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
			'comp' => array(self::BELONGS_TO, 'Company', 'comp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comp_id' => 'Comp',
			'destination_country_codes' => 'Destination Country Codes',
			'destination_name' => 'Destination Name',
			'shipment_method' => 'Shipment Method',
			'est_shipment_days' => 'Est Shipment Days',
			'est_shipment_days_from' => 'Est Shipment Days From',
			'est_shipment_days_to' => 'Est Shipment Days To',
			'shipment_cost1' => 'Shipment Cost1',
			'shipment_order_price1' => 'Shipment Order Price1',
			'shipment_order_price_currency_1' => 'Shipment Order Price Currency 1',
			'shipment_cost2' => 'Shipment Cost2',
			'shipment_order_price2' => 'Shipment Order Price2',
			'shipment_order_price_currency_2' => 'Shipment Order Price Currency 2',
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
		$criteria->compare('comp_id',$this->comp_id,true);
		$criteria->compare('destination_country_codes',$this->destination_country_codes,true);
		$criteria->compare('destination_name',$this->destination_name,true);
		$criteria->compare('shipment_method',$this->shipment_method,true);
		$criteria->compare('est_shipment_days',$this->est_shipment_days);
		$criteria->compare('est_shipment_days_from',$this->est_shipment_days_from);
		$criteria->compare('est_shipment_days_to',$this->est_shipment_days_to);
		$criteria->compare('shipment_cost1',$this->shipment_cost1,true);
		$criteria->compare('shipment_order_price1',$this->shipment_order_price1,true);
		$criteria->compare('shipment_order_price_currency_1',$this->shipment_order_price_currency_1,true);
		$criteria->compare('shipment_cost2',$this->shipment_cost2,true);
		$criteria->compare('shipment_order_price2',$this->shipment_order_price2,true);
		$criteria->compare('shipment_order_price_currency_2',$this->shipment_order_price_currency_2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShipmentInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
