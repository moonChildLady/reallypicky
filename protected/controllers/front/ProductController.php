<?php

class ProductController extends Controller
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
'actions'=>array('index','detail', 'landing'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update','view'),
'users'=>array('admin'),
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
public function actionDetail(){
	
	$token_pef = "o_";
	//assign ->other
	if(isset($_GET['token'])){
	$token = array(
	'token'=>$_GET['token'],
	'product_id'=>isset($_GET['product_id']),
	);
	}else{
	$token = array(
	'token'=>$token_pef.session_id(),
	'product_id'=>isset($_GET['product_id']),
	);
	}
	$utm = array();
	if(isset($_GET['utm_source'])){
		$utm['utm_source'] = $_GET['utm_source'];
	}else{
		$utm['utm_source'] = "other";
	}

	if(isset($_GET['utm_medium'])){
		$utm['utm_medium'] = $_GET['utm_medium'];
	}else{
		$utm['utm_medium'] = "other";
	}	

	if(isset($_GET['utm_content'])){
		$utm['utm_content'] = $_GET['utm_content'];
	}else{
		$utm['utm_content'] = "20140728";
	}
	if(isset($_GET['utm_campaign'])){
		$utm['utm_campaign'] = $_GET['utm_campaign'];
	}else{
		$utm['utm_campaign'] = "20140722_0001";
	}

	Yii::app()->session['utm'] = $utm;
	$OrderReference = new OrderReference;
	$command = Yii::app()->db->createCommand();
	$command->reset();
	Yii::app()->session['token'] = $token;
	$checktoken = $OrderReference->findByAttributes(
	array(
    'token' => Yii::app()->session['token']['token'],
    ));

	if($checktoken===null){
		$result=$command->insert('OrderReference',$token);
		if(isset(Yii::app()->session['memberinfo']['id'])){
		Yii::app()->db->createCommand()->update('OrderReference', 
        array(
            //'order_id'=>new CDbExpression($model->order_id),
            //'total'=>new CDbExpression('total + :ratingAjax', array(':ratingAjax'=>$ratingAjax))
            'member_id'=>new CDbExpression(Yii::app()->session['memberinfo']['id']),
        ),
        'token=:token',
        array(':token'=>Yii::app()->session['token']['token'])
    	);	
		}
	}
	

	

	var_dump(Yii::app()->session['token']);
	//$this->redirect(array('landing'));
	$this->redirect(array('landing', 'id'=>'10001001'));
/*}else{
	$this->redirect(array('landing','product_id'=>'10001001'));
}*/
}
public function actionLanding($id){

	$this->layout='//layout/solo';
	$this->render('detail', array(
		'id'=>$id,
	));
	}
/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
/*$model=new Product;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Product']))
{
$model->attributes=$_POST['Product'];
if($model->save())
$this->redirect(array('view','id'=>$model->product_id));
}

$this->render('create',array(
'model'=>$model,
));*/
$this->redirect("/");
}

/**
* Updates a particular model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id the ID of the model to be updated
*/
public function actionUpdate($id)
{
$model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Product']))
{
$model->attributes=$_POST['Product'];
if($model->save())
$this->redirect(array('view','id'=>$model->product_id));
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
	$this->redirect("/");
/*if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');*/
}

/**
* Lists all models.
*/
public function actionIndex()
{
/*$dataProvider=new CActiveDataProvider('Product');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));*/
$this->redirect("/");
}

/**
* Manages all models.
*/
public function actionAdmin()
{
/*$model=new Product('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Product']))
$model->attributes=$_GET['Product'];

$this->render('admin',array(
'model'=>$model,
));*/
$this->redirect("/");
}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=Product::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
