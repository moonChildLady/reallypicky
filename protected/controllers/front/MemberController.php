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
'actions'=>array('index','view','reg','login','logout','tnc','privacy','Forgetpassword','checkmember','changeForgotpassword','facebooklogin','FacebookProgress', 'FacebookMessage'),
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
//$mail->Host = '192.168.110.71';
$mail->Host = 'smtp.gmail.com:465';
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Username = 'reallypickysp@gmail.com';
$mail->Password = '12345678rr';
$mail->SetFrom('reallypickysp@gmail.com', 'reallypickysp');
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
$body.='<span style="font:normal 12px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\' ;"><center>????????????????????????????????????????????????????????????????????????</center></span>';
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
$body .= '      <a href="https://aster.reallypicky.com">??????????????????</a> | <a href="https://aster.reallypicky.com/member/tnc">????????????</a> | <a href="https://aster.reallypicky.com/member/privacy">????????????</a> | <a href="https://aster.reallypicky.com/order/notice">????????????</a><br />';
$body .= '      <div style="font-size:14px; line-height:21px; margin-top:10px; color:#555;">??????????????????????????????????????????????????????</div>';
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
$body .='			<div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:10px;color:#6070B8;font-size:26px;line-height:36px;">????????????????????????????????????????????????</div>';
$body .= ' ?????????'.$display_name.'?????????';

$body .='<p>???????????????????????????????????????????????????</p>';


$body .='<div align="left" style="border-top:1px dotted #B0B0B0;border-bottom:1px dotted #B0B0B0; margin-bottom:15px; padding:10px 30px;">';
$body .='	????????????????????????'.$email.'<br />';
$body .='	????????????????????????'.$display_name;
$body .='</div>';

$body .='<br />';
$body .='<p align="right">??????????????????????????????????????????</p><br />';

$body .='<p>?????????????????????????????????????????????????????????</p>';

$body .='<p style="font-size:18px;color:#6070B8;"><strong>????????????????????????????????????</strong></p>';
//$body .='??????????????????????????????34??????????????????510-519???<br />';
$body .='?????????????????????(852) 2997-7532<br />';
$body .='?????????<a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a>';

$body .='			</td>';
$body .='  	</tr>';
$body .='		</table>';

$body .=$this->getEmailContentFooter();

$title = "????????????????????????????????????????????????";
$this->EmailSent($body, $email, $display_name, $title);
}
public function emailForgotPassword($email, $temp_token, $displayname){
	$body = $this->getEmailContentHeader();
$body .= '<table border="0" cellspacing="0" cellpadding="20" width="70%" bgcolor="#ffffff" 
     style="min-width:450px; width:70%; border-radius:6px; margin:6px auto 12px auto;box-shadow:0 1px 4px rgba(104,104,104,0.3);border:1px solid #bbb;">';
 $body .='<tr>';
$body .='<td style="font:normal 16px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\'; color:#555; padding:20px 30px;">
   <div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:10px;color:#6070B8;font-size:26px;line-height:36px;">????????????</div>';
$body .='?????????'.$displayname.'???';
$body .='<p>???????????????????????????????????????????????????????????????????????????????????????????????????</p>';
$body .='<div align="center" style="border-top:1px dotted #B0B0B0;border-bottom:1px dotted #B0B0B0; margin-bottom:15px; padding:10px;">';
$body .='?????????<a href="'.Yii::app()->getBaseUrl(true).Yii::app()->createUrl('member/changeforgotpassword').'/'.$temp_token.'">'.Yii::app()->getBaseUrl(true).Yii::app()->createUrl('member/changeforgotpassword').'/'.$temp_token.'</a></div>';

$body .='<p>???????????????????????????????????????????????? <a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a>??????????????????????????? (852) 2997-7532???</p>';
$body .='<p>???????????????????????????????????????????????????????????????????????????????????????????????????</p>';
$body .='<br />';
$body .='<p align="right">??????????????????????????????????????????</p><br />';

$body .='<p>?????????????????????????????????????????????????????????</p>';

$body .='<p style="font-size:18px;color:#6070B8;"><strong>????????????????????????????????????</strong></p>?????????????????????(852) 2997-7532<br />';
$body .='?????????<a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a></td></tr></table>';
$body .=$this->getEmailContentFooter();

$title = "???????????????????????????????????? ????????????";
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

public function actionFacebookLogin(){
//$base = Yii::app()->createUrl("member/FacebookProgres");
$params = array('redirect_uri'=>Yii::app()->getBaseUrl(true).Yii::app()->createUrl('/member/FacebookProgress'),'scope' => 'email');
$loginUrl = Yii::app()->facebook->getLoginUrl($params);
$this->redirect($loginUrl);

}
public function actionFacebookProgress(){
$user = Yii::app()->facebook->getUser();
if ($user){
//Yii::app()->facebook->setAccessToken($accessToken);
$token = Yii::app()->facebook->getAccessToken();
$facebookUserInfo = Yii::app()->facebook->api('/me');
$facebookUser = Yii::app()->facebook->getUser();
$data =  $facebookUserInfo;
$model=new Member;
$url = Yii::app()->user->returnUrl;
$check_email = $model->findByAttributes(
array(
    'email' => $data['email'],
    //'member_type'=>'FACEBOOK',
    //'type' => 'user'
));

if($check_email ===null){
	$name = $data['name'];
	$email = $data['email'];
	$member_type = "FACEBOOK";
	//$model->saveAttributes(array('email' => $email, 'name'=>$name,'account_type'=>$account_type));
$model->email=$email;
$model->display_name=$name;
$model->password=substr($token,0,9);
$model->member_type=$member_type;
if($model->save()){
	$identity=new UserIdentity($model->email,$model->password);
	$identity->authenticate();
	Yii::app()->user->login($identity,0);
	$this->savetoken();
	$this->registrationAlert($model->display_name, $model->email);
	//$this->redirect('/order/checkout/10001001');
}
}else{
	if($check_email->member_type=="NORMAL"){
		$this->redirect('/member/FacebookMessage/1');
		exit;
}else{
	$identity=new UserIdentity($check_email->email,$check_email->password);
	$identity->authenticate();
	Yii::app()->user->login($identity,0);
	$this->savetoken();
	$this->registrationAlert($model->display_name, $model->email);
	//$this->redirect('/order/checkout/10001001');
}
}
$this->redirect($url);

} else {
   $this->redirect('/member/FacebookMessage/2');
   //exit();

}

}
public function actionFacebookMessage($id){
	$this->render('facebookmessage',array(
	'id'=>$id
	));
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
	echo Yii::app()->user->returnUrl;
		$model=new LoginForm('Front');
		$memberModel = new Member;
		// if it is ajax validation request
		$url = $url = Yii::app()->user->returnUrl;
	if(!isset(Yii::app()->session['memberinfo'])) {
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
		
		// display the login form
		$this->render('login',
		array(
		'model'=>$model,
		'member'=>$memberModel,
		'url'=>$url));
	}else{
		$this->redirect($url);
	}

	}
public function actionForgetPassword(){
	$isVaild = "";

	$model = new Member;
if(isset($_POST['Member'])){
	$datalist = $model->findByAttributes(
		array(
		    'email' => $_POST['Member']['email'],
		    'member_type'=>'NORMAL',
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
	$message = "???????????????????????????????????????";
}elseif($id==2){
	$message = "???????????????????????????????????????";
}elseif($id==3){
	$message = "???????????????????????????????????????????????????";
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
//$this->pageTitle = "????????????"; 
$this->render('privacy');
}
public function actionChangePassword(){
$id = Yii::app()->session['memberinfo']['id'];
$model=$this->loadModel($id);
$model->scenario="moeditpassword";
if($model->member_type !="NORMAL"){
	throw new CHttpException(404,'The requested page does not exist.');
	exit;
}
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
		//$params = array( 'next' => '/member');
		//$params = array('next'=>'http://rp.dress4u.hk/','access_token'=>$token);
		/*$params = array('next'=>'http://rp.dress4u.hk/order/checkout/10001001');
 		$logout_url = Yii::app()->facebook->getLogoutUrl($params);*/
 		
		//$this->redirect($logout_url); 

		Yii::app()->user->logout(false);
		unset(Yii::app()->session['memberinfo']); # Remove the session
		//Yii::app()->user->clearStates();
		Yii::app()->facebook->destroySession(); #<- ????????????????????????Session????????????
		$this->redirect('/');
	}
}
