<?php

/**
 * This is the model class for table "Product".
 *
 * The followings are the available columns in table 'Product':
 * @property string $product_id
 * @property string $product_code
 * @property string $product_name
 * @property string $comp_id
 * @property string $parent_product_id
 * @property integer $has_child
 * @property string $brand_name
 * @property string $product_desc
 * @property string $price
 * @property string $discount_price
 * @property string $currency
 * @property string $image
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property OrderItem[] $orderItems
 * @property OrderReference[] $orderReferences
 * @property Product $parentProduct
 * @property Product[] $products
 * @property Company $comp
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_id, currency', 'required'),
			array('has_child', 'numerical', 'integerOnly'=>true),
			array('product_code', 'length', 'max'=>20),
			array('product_name, brand_name, image', 'length', 'max'=>255),
			array('comp_id, parent_product_id', 'length', 'max'=>11),
			array('price, discount_price', 'length', 'max'=>10),
			array('currency', 'length', 'max'=>3),
			array('product_desc, create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, product_code, product_name, comp_id, parent_product_id, has_child, brand_name, product_desc, price, discount_price, currency, image, create_date', 'safe', 'on'=>'search'),
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
			'orderItems' => array(self::HAS_MANY, 'OrderItem', 'product_id'),
			'orderReferences' => array(self::HAS_MANY, 'OrderReference', 'product_id'),
			'parentProduct' => array(self::BELONGS_TO, 'Product', 'parent_product_id'),
			'products' => array(self::HAS_MANY, 'Product', 'parent_product_id'),
			'comp' => array(self::BELONGS_TO, 'Company', 'comp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'product_code' => 'Product Code',
			'product_name' => 'Product Name',
			'comp_id' => 'Comp',
			'parent_product_id' => 'Parent Product',
			'has_child' => 'Has Child',
			'brand_name' => 'Brand Name',
			'product_desc' => 'Product Desc',
			'price' => 'Price',
			'discount_price' => 'Discount Price',
			'currency' => 'Currency',
			'image' => 'Image',
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

		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('product_code',$this->product_code,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('comp_id',$this->comp_id,true);
		$criteria->compare('parent_product_id',$this->parent_product_id,true);
		$criteria->compare('has_child',$this->has_child);
		$criteria->compare('brand_name',$this->brand_name,true);
		$criteria->compare('product_desc',$this->product_desc,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('discount_price',$this->discount_price,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	function getFullimagepath(){
		$path = Yii::app()->theme->name;
		return "/themes/".$path."/img/".$this->image;
	}
}
