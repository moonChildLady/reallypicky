<?php

class OrderController extends Controller
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
* Specifies the access control rules.
* This method is used by the 'accessControl' filter.
* @return array access control rules
*/
public function accessRules()
{
return array(
array('allow',  // allow all users to perform 'index' and 'view' actions
'actions'=>array('index','view','checkout','clear'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
//'actions'=>array('create','update'),
'actions'=>array('create','update','pay', 'payment','RequestPayment','PaypalReturn','thankyou','getShipmentInfo','CustomerUpdateStatus','InternalUpdateStatus'),
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

public function actionCheckout($id)
{
$model=new Member;
$product = new Product;
$orderModel = new Order;
$MemberModel = Member::model()->findByPk(Yii::app()->session['memberinfo']['id']);
$savedInfo = array();
	if(!Yii::app()->user->isGuest){
$savedInfo = array(
'memberaddress'=>$MemberModel->address,
'membertitle'=>$MemberModel->title,
'memberphone'=>$MemberModel->phone,
'memberpostal_code'=>$MemberModel->postal_code,
'membercountry_code'=>$MemberModel->country_code
);
}
//$orderItemModel = new OrderItem;
// Uncomment the following line if AJAX validation is needed
//$this->performAjaxValidation($model);
if(isset($_POST['Member']))
{
$model->attributes=$_POST['Member'];
if($model->save()){
//$this->redirect(array('view','id'=>$model->id));
	$this->redirect(array('product/checkout', 'id'=>$id));
}

}
if(isset($_POST['Member']))
{
$model->attributes=$_POST['Member'];
if($model->save()){
//$this->redirect(array('view','id'=>$model->id));
	$this->redirect(array('product/checkout', 'id'=>$id));
}
}
$criteria = new CDbCriteria();
$criteria->addCondition("parent_product_id = :t1");
$criteria->params[':t1'] = $id;
$subproducts = $product->findAll($criteria);



$this->render('checkout',array(
'model'=>$model,
'subproducts'=>$subproducts,
'orderModel'=>$orderModel,
'savedInfo'=>$savedInfo,
//'orderItemModel'=>$orderItemModel,
));

}
public function actiongetShipmentInfo(){
$ShipmentInfoModel = new ShipmentInfo;
$criteria = new CDbCriteria();
$criteria->addCondition("destination_country_codes = :t1");
$criteria->params[':t1'] = $_POST['Member']['country_code'];
$info = $ShipmentInfoModel->findAll($criteria);
$this->renderJSON(array('info'=>$info));
}

public function actionPay()
{
$model=new Order;
$orderItemModel = new OrderItem;
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Order']))
{
$_POST['Order']['member_id']= Yii::app()->session['memberinfo']['id'];
$_POST['Order']['country_code']= "HK";
$_POST['Order']['order_number']=time();
$command = Yii::app()->db->createCommand();
$model->attributes=$_POST['Order'];
if($model->save()){
	foreach($_POST['product_id'] as $key=>$products){
				$command->reset();
				$result=$command->insert('OrderItem',
				array(
				'order_id'=>$model->order_id,
				'product_id'=>$products,
				'price'=>$_POST['product_cost'][$key],
				'quantity'=>$_POST['quantity'][$key],
				'currency'=>'HKD'
				));
	}
$MemberModel = Member::model()->findByPk(Yii::app()->session['memberinfo']['id']);
$MemberModel->saveAttributes(array('address' => $_POST['Order']['address'], 'postal_code'=>$_POST['Order']['postal_code'],'country_code'=>$_POST['Order']['country_code'],'phone' => $_POST['Order']['phone'],'title'=>$_POST['Order']['title']));
$this->redirect(array('payment','id'=>$model->order_id));

}
/*$this->redirect(array('pay','id'=>$model->order_id));*/

}
	}
public function actionPayment($id)
	{

$model=Order::model()->findByPk($id);


$orderItemModel = new OrderItem;
$criteria = new CDbCriteria();
$criteria->addCondition("order_id = :t1");
$criteria->params[':t1'] = $id;
$products = $orderItemModel->findAll($criteria);

$this->render('payment',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
));


}

/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
public function actionCreate()
{
$model=new Order;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Order']))
{
$model->attributes=$_POST['Order'];
if($model->save())
$this->redirect(array('view','id'=>$model->order_id));
}

$this->render('create',array(
'model'=>$model,
));
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

if(isset($_POST['Order']))
{
$model->attributes=$_POST['Order'];
if($model->save())
$this->redirect(array('view','id'=>$model->order_id));
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
$dataProvider=new CActiveDataProvider('Order',array('criteria' => array( 
         //'condition'=>'isActive=1', 
          'order' => 'order_id DESC',
      ),));
$model = new Order;
$this->render('index',array(
'dataProvider'=>$dataProvider,
'model'=>$model,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Order('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Order']))
$model->attributes=$_GET['Order'];

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
$model=Order::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
public function actionClear(){
        $session = Yii::app()->session['cart'];
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        //$this->render('index', array('session'=>NULL));
         

    }

public function actionRequestPayment($id)
      {
          $e=new ExpressCheckout;
		$orderItemModel = new OrderItem;
	$criteria = new CDbCriteria();
$criteria->addCondition("order_id = :t1");
$criteria->params[':t1'] = $id;
$product = $orderItemModel->findAll($criteria);
$products = array();
foreach($product as $key=>$pt){
	$products[$key] = array('NAME'=>$pt->product->product_name,'AMOUNT'=>$pt->price,'QTY'=>$pt->quantity);
}
	//$products = array();
/*echo "<pre>";
print_r($porducts);
	echo "</pre>";*/
          /*$products=array(

                '0'=>array(
                      'NAME'=>'p1',
                      'AMOUNT'=>'250.00',
                      'QTY'=>'2'
                      ),
                '1'=>array(
                      'NAME'=>'p2',
                      'AMOUNT'=>'300.00',
                      'QTY'=>'2'
                      ),
                '2'=>array(
                      'NAME'=>'p3',
                      'AMOUNT'=>'350.00',
                      'QTY'=>'2'
                      ),

                );*/
                         /*Optional */
            $shipping_address=array(
 
            'FIRST_NAME'=>'Sirin',
            'LAST_NAME'=>'K',
            'EMAIL'=>'sirinibin2006@gmail.com',
            'MOB'=>'0918606770278',
            'ADDRESS'=>'mannarkkad', 
            'SHIPTOSTREET'=>'mannarkkad',
            'SHIPTOCITY'=>'palakkad',
            'SHIPTOSTATE'=>'kerala',
            'SHIPTOCOUNTRYCODE'=>'IN',
            'SHIPTOZIP'=>'678761'
                                          ); 

            //$e->setShippingInfo($shipping_address); // set Shipping info Optional
 
            $e->setCurrencyCode("HKD");//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)

            $e->setProducts($products); /* Set array of products*/
 
            $e->setShippingCost(5.5);/* Set Shipping cost(Optional) */
 
            $e->returnURL=Yii::app()->createAbsoluteUrl("/order/PaypalReturn");
 
             $e->cancelURL=Yii::app()->createAbsoluteUrl("/order/PaypalCancel");

            $result=$e->requestPayment(); 
 
            /*
              The response format from paypal for a payment request
            Array
        (
            [TOKEN] => EC-9G810112EL503081W
            [TIMESTAMP] => 2013-12-12T10:29:35Z
            [CORRELATIONID] => 67da94aea08c3
            [ACK] => Success
            [VERSION] => 65.1
            [BUILD] => 8725992
        )
                */

 
        if(strtoupper($result["ACK"])=="SUCCESS")
          {
            /*redirect to the paypal gateway with the given token */
			//$paypalModel = new PaypalOrder;

            header("location:".$e->PAYPAL_URL.$result["TOKEN"]);
			$command = Yii::app()->db->createCommand();
				$command->reset();
				$result=$command->insert('PaypalOrder',
				array(
				'order_id'=>$id,
				'token'=>$result["TOKEN"],
				));
          }
 

 
         }          
 
        public function actionPaypalReturn()
        {
         $e=new ExpressCheckout;
         $paymentDetails=$e->getPaymentDetails($_REQUEST['token']); //1.get payment details by using the given token
			if($paymentDetails['ACK']=="Success")
            {
            $ack=$e->doPayment($paymentDetails);  //2.Do payment
 

			if($ack['ACK']=="Success"&&$ack['PAYMENTSTATUS']=="Completed"){
			echo "<pre>";
            print_r($ack);
            echo "</pre>";
			echo $ack['TOKEN'];
				$token = $ack['TOKEN'];
				$transation_id=$ack['TRANSACTIONID'];
				$transation_date = $ack['TIMESTAMP'];
				$amount = $ack['AMT'];
				$fee_amount = $ack['PAYMENTINFO_0_FEEAMT'];
				$payment_status = $ack['PAYMENTSTATUS'];

				$criteria = new CDbCriteria();
				$criteria->addCondition("token = :t1");
				$criteria->params[':t1'] = $token;
				$PaypalModel = PaypalOrder::model()->findByAttributes(array('token'=>$token));
				$PaypalModel->saveAttributes(array('transation_id' => $transation_id, 'transation_date'=>$transation_date,'amount' => $amount,'fee_amount'=>$fee_amount,'payment_status'=>$payment_status));

				/*$criteria1 = new CDbCriteria();
				$criteria1->addCondition("order_id = :t1");
				$criteria1->params[':t1'] = $PaypalModel->order_id;*/
				$orderModel = Order::model()->findByAttributes(array('order_id'=>$PaypalModel->order_id));
				$orderModel->saveAttributes(array('order_status' => "1", "order_status_internal"=>"1"));
				$this->redirect(array('order/thankyou','id'=>$PaypalModel->order_id));
			}
            }
 
        }
        public function actionPaypalCancel()
        {  
           /*The user flow  wil come here when a user cancels the payment */
           /*Do what you want*/   
        }
	public function actionThankyou($id)
	{

$model=Order::model()->findByPk($id);
$orderItemModel = new OrderItem;
$criteria = new CDbCriteria();
$criteria->addCondition("order_id = :t1");
$criteria->params[':t1'] = $id;
$products = $orderItemModel->findAll($criteria);

$this->render('thankyou',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
));
	}
public function actionCustomerUpdateStatus(){
//$orderModel = Order::model()->findByPk($_POST['id']);
Order::model()->updateByPk($_POST['order_id'],array('order_status' => $_POST['id']));
}
	public function actionInternalUpdateStatus(){
//$orderModel = Order::model()->findByPk($_POST['id']);
Order::model()->updateByPk($_POST['order_id'],array('order_status_internal' => $_POST['id']));
}

}

