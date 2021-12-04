<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class MemberLogin extends CFormModel
{
	public $email;
	public $password;
	public $rememberMe;
	public $confirmemail;
	public $display_name;
	public $userType; // added new member

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			//'rememberMe'=>'自動登陸',
			'member_id' => 'Member',
			'title' => 'Title',
			'name' => '帳戶名稱',
			'phone' => 'Phone',
			'address' => '配送地址',
			'postal_code' => '郵區編號',
			'country_code' => '國家/地區',
			'email' => '登入電郵',
			'password' => '設置密碼',
			'display_name' => '顯示名稱',
			'status' => 'Status',
			'create_date' => 'Create Date',
			'last_modified_date' => 'Last Modified Date',
			'confirmemail'=>'確認電郵',
			'bill_address'=>'帳單地址',
			'contact_phone'=>'聯絡電話',
			'old_password'=>'舊密碼',
			'new_password'=>'新密碼',
		);
	}
	public function __construct($arg='Front') { // default it is set to Front     
        $this->userType = $arg;
    }
	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->userType = $this->userType; // this will pass flag to the UserIdentity class
			if(!$this->_identity->authenticate())
				$this->addError('password','登入電郵或密碼錯誤。');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
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
}
