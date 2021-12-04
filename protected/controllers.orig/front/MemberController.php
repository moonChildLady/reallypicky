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
'actions'=>array('index','view','reg','login'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update','MemberCenter','changepassword','Editpersonal','Editdelivery'),
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

public function actionReg()
{
$model=new Member;

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
	//$usersession = array("email"=>$MemberModel->email,'name'=>$MemberModel->name,'id'=>$MemberModel->member_id);
	//Yii::app()->session['memberinfo'] = $usersession;
	$OrderReference = OrderReference::model()->findByAttributes(array('token'=>Yii::app()->session['token']['token']));
	//$OrderReference->saveAttributes(array('member_id' => $model->member_id));
	$identity=new UserIdentity($MemberModel->email,$MemberModel->password);
	$identity->authenticate();
	Yii::app()->user->login($identity,0);
	//$this->redirect(Yii::app()->request->urlReferrer);
	//Yii::app()->urlManager->parseUrl(Yii::app()->request)
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
				//$this->redirect(Yii::app()->request->urlReferrer);
				//$this->renderJSON(array('success'=>'success'));
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
				//$this->redirect(Yii::app()->request->urlReferrer);
				//$this->renderJSON(array('success'=>'success'));
				$this->renderJSON(array('success'=>'ok'));
				}else{
			$this->renderJSON(array('success'=>'fail'));
			}
		}
		// display the login form
		$this->render('login',
		array(
		'model'=>$model,
		'member'=>$memberModel
			 )
					 );

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

public function actionChangePassword(){
$id = Yii::app()->session['memberinfo']['id'];
$model=$this->loadModel($id);
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
}
