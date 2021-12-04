<?php

class MemberController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='//layouts/column2';

/**
* @return array action filters
*/
public function filters()
{
return array(
'accessControl', // perform access control for CRUD operations
);
}

/**
* Specifies the access control rules.
* This method is used by the 'accessControl' filter.
* @return array access control rules
*/
public function accessRules()
{
return array(
array('allow',  // allow all users to perform 'index' and 'view' actions
'actions'=>array('index','view','reg','login','logout','tnc','privacy','Forgetpassword','checkmember','changeForgotpassword'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('MemberCenter','changepassword','Editpersonal','Editdelivery'),
'users'=>array('@'),
),
array('allow', // allow admin user to perform 'admin' and 'delete' actions
'actions'=>array('admin','delete'),
'users'=>array('admin'),
),
array('deny',  // deny all users
'users'=>array('*'),
),
);
}

/**
* Displays a particular model.
* @param integer $id the ID of the model to be displayed
*/
public function EmailSent($body, $email_to, $customer_name, $emailtitle){
	Yii::import('application.extensions.phpmailer.JPhpMailer');
$mail = new JPhpMailer;
$mail->IsSMTP();
$mail->Host = '192.168.110.71';
//$mail->Host = 'smtp.gmail.com:465';
//$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
//$mail->Username = 'reallypickysp@gmail.com';
//$mail->Password = '12345678rr';
//$mail->SetFrom('reallypickysp@gmail.com', 'reallypickysp');
$mail->SetFrom('reallypicky@aster.com.hk', 'reallypicky');
$mail->Encoding = 'quoted-printable';
$mail->Subject = $emailtitle;
$mail->AltBody = $emailtitle;
$mail->CharSet = 'UTF-8';
$body = wordwrap($body, 50);
$mail->MsgHTML($body);
$mail->AddAddress($email_to, $customer_name);
// TESTING ONLY
$mail->AddBCC('reallypickysp@gmail.com','reallypickysp@gmail.com');
$mail->Send();
}

public function getEmailContentHeader() {
$body = '<br />';
$body.='<span style="font:normal 12px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\' ;"><center>如你未能完整閱讀此郵件，請先顯示或下載所有圖片。</center></span>';
$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dddddd">';
$body.='<tr>';
$body.='	<td align="center">';
  
$body.='  	<table border="0" cellspacing="0" cellpadding="0" width="66%" style="min-width:420px; width:66%;">';
$body.='  	<tr>';
$body.='    	<td style="width:247px;height:70px;background:url(https://aster.reallypicky.com/images/edm/edm-title.png) no-repeat 0 35px;"></td>';
$body.='    	<td>&nbsp;</td>';
$body.='      <td style="width: 119px;height:70px;background:url(https://aster.reallypicky.com/images/edm/edm-aster-logo.png) no-repeat top;"></td>';
$body.='  	</tr>';
$body.='		</table>';

return $body;
}

public function getEmailContentFooter() {
$body = '		<table border="0" cellspacing="0" cellpadding="20" width="70%" bgcolor="#ffffff" ';
$body .= '    	style="min-width:450px; width:70%; border-radius:6px; margin:6px auto 12px auto; box-shadow:0 1px 4px rgba(104,104,104,0.3);border:1px solid #bbb;">';
$body .= '  	<tr>';
$body .= '    	<td align="center" style="font:normal 16px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\' ;">';
$body .= '      <a href="https://aster.reallypicky.com">購物優惠首頁</a> | <a href="https://aster.reallypicky.com/member/tnc">使用條款</a> | <a href="https://aster.reallypicky.com/member/privacy">私隱政策</a> | <a href="https://aster.reallypicky.com/order/notice">使用說明</a><br />';
$body .= '      <div style="font-size:14px; line-height:21px; margin-top:10px; color:#555;">此乃系統自動傳送的郵件，請勿直接回覆</div>';
$body .= '			</td>';
$body .= '  	</tr>';
$body .= '		</table>';


$body .= '  	<table border="0" cellspacing="0" cellpadding="0" width="66%" style="min-width:420px; width:66%; margin:0 auto;">';
$body .= '  	<tr>';
$body .= '    	<td style="width:92px;height:20px;background:url(https://aster.reallypicky.com/images/edm/reallypicky.png) no-repeat top;"></td>';
$body .= '    	<td></td>';
$body .= '      <td align="right" ';
$body .= '      	style="color:#fff;font:normal 10px/17px Arial,Helvetica,Verdana,Geneva,sans-serif;">&copy; 2014 Softpub.com Ltd</td>';
$body .= '  	</tr>';
$body .= '		</table>';

$body .= '	</td>';
$body .= '</tr>';
$body .= '</table>';
$body .= '<br /><br />';

return $body;
}


public function actionView($id)
{
$this->render('view',array(
'model'=>$this->loadModel($id),
));
}
protected function renderJSON($data)
	{
	    header('Content-type: application/json; charset=utf-8');
	    echo CJSON::encode($data);

	    foreach (Yii::app()->log->routes as $route) {
	        if($route instanceof CWebLogRoute) {
	            $route->enabled = false; // disable any weblogroutes
	        }
	    }
	    Yii::app()->end();
	}
/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
$model=new Member;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Member']))
{
$model->attributes=$_POST['Member'];
if($model->save())
$this->redirect(array('view','id'=>$model->member_id));
}

$this->render('create',array(
'model'=>$model,
));
}
public function registrationAlert($display_name, $email){

$body = $this->getEmailContentHeader();

$body .='  	<table border="0" cellspacing="0" cellpadding="20" width="70%" bgcolor="#ffffff" ';
$body .='    	style="min-width:450px; width:70%; border-radius:6px; margin:6px auto 12px auto;box-shadow:0 1px 4px rgba(104,104,104,0.3);border:1px solid #bbb;">';
$body .='  	<tr>';
$body .='    	<td style="font:normal 16px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\'; color:#555; padding:20px 30px;">';
$body .='			<div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:10px;color:#6070B8;font-size:26px;line-height:36px;">「雅施精挑細選購物優惠」歡迎您！</div>';
$body .= ' 親愛的'.$display_name.'您好：';

$body .='<p>歡迎加入「雅施精挑細選購物優惠」。</p>';


$body .='<div align="left" style="border-top:1px dotted #B0B0B0;border-bottom:1px dotted #B0B0B0; margin-bottom:15px; padding:10px 30px;">';
$body .='	你的登入電郵是：'.$email.'<br />';
$body .='	你的顯示名稱是：'.$display_name;
$body .='</div>';

$body .='<br />';
$body .='<p align="right">「雅施精挑細選購物優惠」謹上</p><br />';

$body .='<p>如有問題，請與我們的客戶服務中心聯絡。</p>';

$body .='<p style="font-size:18px;color:#6070B8;"><strong>「雅施精挑細選購物優惠」</strong></p>';
//$body .='香港九龍新蒲崗大有街34號新科技廣場510-519室<br />';
$body .='客戶服務熱線：(852) 2997-7532<br />';
$body .='電郵：<a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a>';

$body .='			</td>';
$body .='  	</tr>';
$body .='		</table>';

$body .=$this->getEmailContentFooter();

$title = "「雅施精挑細選購物優惠」歡迎您！";
$this->EmailSent($body, $email, $display_name, $title);
}
public function emailForgotPassword($email, $temp_token, $displayname){
	$body = $this->getEmailContentHeader();
$body .= '<table border="0" cellspacing="0" cellpadding="20" width="70%" bgcolor="#ffffff" 
     style="min-width:450px; width:70%; border-radius:6px; margin:6px auto 12px auto;box-shadow:0 1px 4px rgba(104,104,104,0.3);border:1px solid #bbb;">';
 $body .='<tr>';
$body .='<td style="font:normal 16px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\'; color:#555; padding:20px 30px;">
   <div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:10px;color:#6070B8;font-size:26px;line-height:36px;">密碼重設</div>';
$body .='親愛的'.$displayname.'，';
$body .='<p>您向「雅施精挑細選購物優惠」要求重設密碼，請點擊如下鏈接修改密碼。</p>';
$body .='<div align="center" style="border-top:1px dotted #B0B0B0;border-bottom:1px dotted #B0B0B0; margin-bottom:15px; padding:10px;">';
$body .='鏈接：<a href="'.Yii::app()->getBaseUrl(true).Yii::app()->createUrl('member/changeforgotpassword').'/'.$temp_token.'">'.Yii::app()->getBaseUrl(true).Yii::app()->createUrl('member/changeforgotpassword').'/'.$temp_token.'</a></div>';

$body .='<p>如仍未能重新設定密碼，請發電郵至 <a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a>或於辦公時間內致電 (852) 2997-7532。</p>';
$body .='<p>如果您沒有向「雅施精挑細選購物優惠」要求重設密碼，敬請忽略此郵件。</p>';
$body .='<br />';
$body .='<p align="right">「雅施精挑細選購物優惠」謹上</p><br />';

$body .='<p>如有問題，請與我們的客戶服務中心聯絡。</p>';

$body .='<p style="font-size:18px;color:#6070B8;"><strong>「雅施精挑細選購物優惠」</strong></p>客戶服務熱線：(852) 2997-7532<br />';
$body .='電郵：<a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a></td></tr></table>';
$body .=$this->getEmailContentFooter();

$title = "「雅施精挑細選購物優惠」 密碼重設";
$this->EmailSent($body, $email, $displayname, $title);
}
public function savetoken(){
	$OrderReference = new OrderReference;
	if(isset(Yii::app()->session['token'])){
					$token_list = $OrderReference->findByAttributes(
					array(
					    'token' => Yii::app()->session['token']['token'],//where member_id is null, update member_id, else check token, member_id, insert
					    'member_id'=> null,
					));
					if(count($token_list)>0){
					Yii::app()->db->createCommand()
				    ->update('OrderReference', 
				        array(
				            'member_id'=>new CDbExpression(Yii::app()->session['memberinfo']['id']),
				            //'total'=>new CDbExpression('total + :ratingAjax', array(':ratingAjax'=>$ratingAjax))
				        ),
				        'token=:token',
				        //'member=:member',
				        array(':token'=>Yii::app()->session['token']['token']
				        	)
				    );
					}
					$token_list1 = $OrderReference->findByAttributes(
					array(
					    'token' => Yii::app()->session['token']['token'],//where member_id is null, update member_id, else check token, member_id, insert
					    'member_id'=> Yii::app()->session['memberinfo']['id'],
					),
					array(
					    'limit' => 1,
					));
					if($token_list1 ===null){
					$command = Yii::app()->db->createCommand();
					$command->reset();
					$token = array(
						'token'=>Yii::app()->session['token']['token'],
						'product_id'=>Yii::app()->session['token']['product_id'],
						'member_id'=>Yii::app()->session['memberinfo']['id']
					);
					$result=$command->insert('OrderReference',$token);
					}
					}
}
public function actionReg()
{
$model=new Member;
$model->scenario="register";
// Uncomment the following line if AJAX validation is needed
 $this->performAjaxValidation($model);

if(isset($_POST['Member']))
{
//var_dump($_POST['Member']);
$model->attributes=$_POST['Member'];
if($model->save()){
//$this->redirect(array('view','id'=>$model->member_id));
	//$this->renderJSON(array('success'=>'success'));
	$MemberModel = Member::model()->findByPk($model->member_id);
	//$OrderReference->saveAttributes(array('member_id' => $model->member_id));
	$identity=new UserIdentity($MemberModel->email,$MemberModel->password);
	$identity->authenticate();
	Yii::app()->user->login($identity,0);
	$this->savetoken();
	//$this->redirect(Yii::app()->request->urlReferrer);
	//Yii::app()->urlManager->parseUrl(Yii::app()->request)
	$this->registrationAlert($MemberModel->display_name, $MemberModel->email);
	$this->redirect('/order/checkout/10001001');

}

}

}

public function actionLogin(){
		$model=new LoginForm('Front');
		$memberModel = new Member;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Member']))
		{
			$model->attributes=$_POST['Member'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->savetoken();
				$this->renderJSON(array('success'=>'OK'));
				}else{
			$this->renderJSON(array('success'=>'fail'));
			}
		}
		if(isset($_POST['LoginForm']))
			{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				
				$this->renderJSON(array('success'=>'ok'));
				}else{
			$this->renderJSON(array('success'=>'fail'));
			}
		}
		$url = $url = Yii::app()->user->returnUrl;
		// display the login form
		$this->render('login',
		array(
		'model'=>$model,
		'member'=>$memberModel,
		'url'=>$url));

	}
public function actionForgetPassword(){
	$isVaild = "";

	$model = new Member;
if(isset($_POST['Member'])){
	$datalist = $model->findByAttributes(
		array(
		    'email' => $_POST['Member']['email'],
		),
		array(
		    'limit' => 1,
		));
	
	if(count($datalist)==0){
		//$isVaild = "invalid";
		$this->redirect(array('member/Checkmember','id'=>'2'));
	}else{
		$isVaild = "valid";
		$temp_token = md5($datalist->email.$datalist->password.$datalist->create_date);
		$this->emailForgotPassword($datalist->email, $temp_token, $datalist->display_name);
		$this->redirect(array('member/Checkmember','id'=>'1'));
	}
	

}
	$this->render('forgetpassword',array(
	'isVaild'=>$isVaild,
	'model'=>$model,
	//'datalist'=>$datalist
	));
}
public function actionCheckmember($id){
if($id==1){
	$message = "已把重設密碼電郵發送給你！";
}elseif($id==2){
	$message = "沒有這個帳號，請檢查再試！";
}elseif($id==3){
	$message = "已成功更新密碼，請使用新密碼登入。";
}
$this->render('checkpasswordmessage',array(
	'message'=>$message
	));
}
public function actionChangeForgotpassword($temp_token){
	//echo $temp_token;
	$model = new Member;
	$model->scenario="forgetpassword";
	$criteria = new CDbCriteria;
	//$criteria->select='email';
	$criteria->condition = "md5(concat(email,password,create_date))=:t1";
	$criteria->params[':t1'] = $temp_token;
	$modelmember = Member::model()->find($criteria); 

	if(count($modelmember)==0){
		throw new CHttpException(404,'The requested page does not exist.');
		return $modelmember;
		//var_dump($modelmember);
	}else{
		$this->render('newpassword',array(
			'model'=>$model,
			'modelmember'=>$modelmember
		));
	}
	if(isset($_POST['Member'])){
		$modelmember->password = $_POST['Member']['password'];
		if($modelmember->update()){
		$this->redirect(array('member/Checkmember','id'=>'3'));
		}
	}
}
/**
* Updates a particular model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id the ID of the model to be updated
*/

public function actionMemberCenter(){
$id = Yii::app()->session['memberinfo']['id'];
$model=$this->loadModel($id);	
$this->render('membercenter',array(
'model'=>$model,
));
}
public function actiontnc(){
$this->render('tnc');
}
public function actionprivacy(){
//$this->pageTitle = "私隱政策"; 
$this->render('privacy');
}
public function actionChangePassword(){
$id = Yii::app()->session['memberinfo']['id'];
$model=$this->loadModel($id);
$model->scenario="moeditpassword";

if(isset($_POST['Member']))
{
	$model->attributes=$_POST['Member'];
	$old_password = $_POST['Member']['old_password'];
	$new_password = $_POST['Member']['new_password'];
	$MemberModel = Member::model()->findByPk($id);
	if($old_password != $MemberModel->password){
		//$this->redirect(array('member/changepassword', 'msg'=>'error'));
		$this->renderJSON(array('status'=>2));
	}else{
		$MemberModel->saveAttributes(array('password'=>$new_password));
		$this->renderJSON(array('status'=>1));
		//$this->redirect(array('member/membercenter'));
	}
	//Yii::app()->end();
}

$this->render('changepassword',array(
	'model'=>$model,
));
}

public function actionEditpersonal(){
	$model = new Member;
$id = Yii::app()->session['memberinfo']['id'];
$model=$this->loadModel($id);

if(isset($_POST['Member']))
{
	$model->attributes=$_POST['Member'];
	$MemberModel = Member::model()->findByPk($id);
	$MemberModel->saveAttributes(array('contact_phone'=>$_POST['Member']['contact_phone'], 'bill_address'=>$_POST['Member']['bill_address'],'display_name'=>$_POST['Member']['display_name']));
	$this->renderJSON(array('status'=>1));
	/*if($model->save()){
		$this->renderJSON(array('status'=>1));
	}else{
		print_r($model->getErrors());
		$this->renderJSON(array('status'=>2));
	}*/
	//Yii::app()->end();
}

$this->render('editpersonal',array(
	'model'=>$model,
));
}

public function actionEditdelivery(){
	$model = new Member;
$id = Yii::app()->session['memberinfo']['id'];
$model=$this->loadModel($id);

if(isset($_POST['Member']))
{
	$model->attributes=$_POST['Member'];
	$MemberModel = Member::model()->findByPk($id);
	$MemberModel->saveAttributes(array('address'=>$_POST['Member']['address'], 'postal_code'=>$_POST['Member']['postal_code'],'country_code'=>$_POST['Member']['country_code'],'country'=>$_POST['Member']['country'],'name'=>$_POST['Member']['name'],'title'=>$_POST['Member']['title']));
	$this->renderJSON(array('status'=>1));
	/*if($model->save()){
		$this->renderJSON(array('status'=>1));
	}else{
		print_r($model->getErrors());
		$this->renderJSON(array('status'=>2));
	}*/
	//Yii::app()->end();
}

$this->render('editdelivery',array(
	'model'=>$model,
));
}


public function actionUpdate($id)
{
$model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Member']))
{
$model->attributes=$_POST['Member'];
if($model->save())
$this->redirect(array('view','id'=>$model->member_id));
}

$this->render('update',array(
'model'=>$model,
));
}

/**
* Deletes a particular model.
* If deletion is successful, the browser will be redirected to the 'admin' page.
* @param integer $id the ID of the model to be deleted
*/
public function actionDelete($id)
{
if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('Member');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Member('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Member']))
$model->attributes=$_GET['Member'];

$this->render('admin',array(
'model'=>$model,
));
}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=Member::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='member-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
	public function actionLogout()
	{
		Yii::app()->user->logout(false);
		unset(Yii::app()->session['memberinfo']); # Remove the session
		//Yii::app()->user->clearStates();
		$this->redirect('/');
	}
}
