<?php

/**
 * This is the model class for table "Member".
 *
 * The followings are the available columns in table 'Member':
 * @property string $member_id
 * @property string $title
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $postal_code
 * @property string $country_code
 * @property string $email
 * @property string $password
 * @property string $display_name
 * @property string $status
 * @property string $create_date
 * @property string $last_modified_date
 *
 * The followings are the available model relations:
 * @property CountryCode $countryCode
 * @property Order[] $orders
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $confirmemail;
	public $old_password;
	public $confirmpassword;
	public $new_password;
	public $rememberMe;
	public $userType; // added new member
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'unique','message'=>'{value} 已被使用，請使用其他{attribute}'),


			array('name, email, confirmemail, password, bill_address,contact_phone', 'required', 'message'=>'{attribute} 不能留空', 'on'=>'updateinfo'),//1



			array('name, email, password, bill_address,contact_phone', 'required', 'message'=>'{attribute} 不能留空', 'on'=>'backendupdateinfo'),//1
			
			array( 'old_password,new_password', 'required', 'message'=>'{attribute} 不能留空', 'on'=>'editpassword'), //1
			array('contact_phone, phone', 'match', 'pattern'=>'/^[0-9]+$/', 'message'=>"請再次輸入"),
			array('display_name, email, password', 'required', 'message'=>'{attribute} 不能留空'),

			array('display_name, email, password, confirmemail, ', 'required', 'message'=>'{attribute} 不能留空', 'on'=>'register'),//1
			array('password, confirmpassword', 'required', 'message'=>'{attribute} 不能留空', 'on'=>'forgetpassword'),
			array('create_date, last_modified_date,member_type', 'safe'),
			array('title, phone, postal_code', 'length', 'max'=>20),
			array('name, address, email, display_name,country', 'length', 'max'=>255),
			array('password, confirmpassword,old_password,new_password', 'length', 'max'=>10),
			array('country_code', 'length', 'max'=>2),
			array('password', 'length', 'max'=>10),
			array('status', 'length', 'max'=>8),
			array('confirmemail', 'compare', 'compareAttribute'=>'email', 'on'=>'register', 'message'=>'{attribute}  請再次輸入。'),
			array('email', 'email', 'checkMX'=>true, 'message'=>'請輸入有效的電郵地址'),
			array('password, confirmpassword', 'CRegularExpressionValidator', 'pattern'=>'/^([0-9a-zA-Z]+){6}$/', 'message'=>'請輸入6個數字及字母的組合','on'=>'forgetpassword'),
			array('password', 'CRegularExpressionValidator', 'pattern'=>'/^([0-9a-zA-Z]+){6}$/', 'message'=>'請輸入6個數字及字母的組合','on'=>'forgetpassword, register'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('member_id, title, name, phone, address, postal_code, country_code, email, password, display_name, status, create_date, last_modified_date,contact_phone', 'safe', 'on'=>'search'),
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
			'countryCode' => array(self::BELONGS_TO, 'CountryCode', 'country_code'),
			'orders' => array(self::HAS_MANY, 'Order', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' => 'Member',
			'title' => '稱謂',
			'name' => '收貨人',
			'phone' => '電話',
			'address' => '配送地址',
			'postal_code' => '郵區編號',
			'country_code' => '國家/地區',
			'country' => '其他國家',
			'email' => '登入電郵',
			'password' => '設置密碼',
			'display_name' => '顯示名稱',
			'status' => '狀態',
			'create_date' => '創建日期',
			'last_modified_date' => '最後更新',
			'confirmemail'=>'確認電郵',
			'confirmpassword'=>'確認密碼',
			'bill_address'=>'帳單地址',
			'contact_phone'=>'聯絡電話',
			'old_password'=>'舊密碼',
			'new_password'=>'新密碼',
			'member_type'=>'新密碼'
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

		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('email',$this->email,true);
		//$criteria->compare('password',$this->password,true);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('last_modified_date',$this->last_modified_date,true);
		//$criteria->compare('confirmemail',$this->confirmemail,true);
		$criteria->compare('bill_address',$this->bill_address,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('account_type',$this->member_type,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/*public function __construct($arg='Front') { // default it is set to Front     
        $this->userType = $arg;
    }
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->userType = $this->userType; // this will pass flag to the UserIdentity class
			if(!$this->_identity->authenticate())
				$this->addError('[login]password','登入電郵或密碼錯誤。');
		}
	}*/
}
