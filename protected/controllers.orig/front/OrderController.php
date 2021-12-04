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
public function currencySign($sign){
  return ($sign=="HKD")?"HK$":"US$";
}
public function accessRules()
{
return array(
array('allow',  // allow all users to perform 'index' and 'view' actions
'actions'=>array('checkout','clear','getShipmentInfo'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
//'actions'=>array('create','update'),
'actions'=>array('index','view','create','update','pay', 'payment','RequestPayment','PaypalReturn','thankyou','PaypalCancel'),
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
public function sendEmail($order_id, $member_id, $products, $totalsum){
$MemberModel = Member::model()->findByPk($member_id);
$orderModel = Order::model()->findByPk($order_id);
$countryModel = CountryCode::model()->findByPK($orderModel->country_code);
$pickuplocation = array("銅鑼灣分店","尖沙咀分店","黃大仙分店","太子分店","荃灣分店","屯門分店","元朗分店");
$body = '<div><table width="800" border="0" cellspacing="0">';
$body .='		<tbody><tr>';
$body .='		<td><p><img src="http://www.aster.com.hk/images/log.jpg"><br>';
$body.='		訂單編號 '.time().'<br><br>';
$body.='		親愛的'.$MemberModel->name.'：<br><br>';
$body.='		感謝您於雅施購物網購物！我們確認收到閣下訂單，內容如下：</p>收貨人：'.$orderModel->name.'<br>';
$body.='	聯絡電話： '.$MemberModel->phone.' <br>';
$body.='	收貨地址： '.nl2br($orderModel->address).'<br>';
$body.='	貨運方法： '.($orderModel->shipment_method == 'BY COURIER') ? '速遞 / 掛號<br>':'門市自取<br>';
if($orderModel->shipment_method == 'SELF PICKUP'){ 
	$body.=	'門市地點： '.$pickuplocation[$orderModel->self_pickup_location].'<br>';
	$body.=	'取貨編號： '.$orderModel->verification_code.'<br>';
}
$body.='	付款方法： 信用卡<br>';
$body .= '備註： '.($orderModel->remarks ===null) ?'没有':$orderModel->remarks.'<br>';
$body .='贈言： 没有<br>';
$body.='</td></tr>';
$body.='	<tr><td>&nbsp;</td></tr>';
$body.='	<tr>';
$body.='	<td><table width="800" border="1" cellspacing="0" cellpadding="0"><tbody><tr><td width="200" align="center"><strong>產品</strong></td><td align="center"><strong>數量</strong></td><td width="150" align="center"><strong>價格</strong></td>';
$body.='<td width="150" align="center"><strong>小計</strong></td></tr>';
foreach($products as $key =>$product){ 
$body.='	<tr><td align="center">'.$product['name'].'</td><td align="center">'.$product['qty'].'</td><td align="center">'.$orderModel->total_order_price_currency.$product['amount'].'</td><td align="center">'.$orderModel->total_order_price_currency.$product['qty']*$product['amount'].'</td></tr>';
}
$body.='	<tr><td align="right" colspan="5"><table width="250" border="0" cellspacing="0" cellpadding="0">';
	$body.='<tbody><tr>';
$body.='	<td width="50%" height="30" valign="bottom">合共</td>';
$body.='	<td width="50%" valign="bottom">'.$orderModel->total_order_price_currency.$totalsum.'</td>';
$body.='	</tr>';
$body.='	<tr>';
$body.='	<td width="50%" height="30" valign="bottom">運費</td>';
$body.='	<td width="50%" valign="bottom">'.$orderModel->total_order_price_currency.$orderModel->shipment_cost.'</td>';
$body.='	</tr>';
$body.='	<tr>';
$body.='	<td>總額</td>';
$body.='	<td>'.$orderModel->total_order_price_currency.$totalsum.'</td>';
$body.='	</tr>';
$body.='		<tr>';
$body.='		<td width="40%" height="30" valign="bottom">可獲積分</td>';
$body.='		<td width="60%" valign="bottom">95</td>';
$body.='		</tr></tbody></table></td>';
$body.='		</tr>';
$body.='		</tbody></table></td>';
$body.='		</tr>';
$body.='		<tr><td>&nbsp;</td></tr>';
$body.='		<tr>';
$body.='		<td><p><strong>注意事項</strong><br>';
$body.=		' 1）貨運時間︰詳情請參考送貨服務 (送貨服務連至<a href="http://www.aster.com.hk/footerInfo.php?footer_id=5&amp;lang=2">http://www.aster.com.hk/footerInfo.php?footer_id=5&amp;lang=2</a>)<br>';
$body.=	'2） 雅施購物網訂單截件時間為工作天(星期一至五)下午六時正(香港時間)，故截件時間以後建立並確認付款的訂單將會順延至下一個工作天處理。<br>';
$body.=	'		3） 當訂單付運後，帳單狀況會改為「已付運」。如欲查詢訂單詳情，請登入「我的帳戶」內「購物紀錄」。</p>';
$body.=	'		<p>雅施化粧品中心官方網站敬上<br>';
$body.=	'		<p>_____________________________________________________________________<br>';
$body.=	'		  <strong>選擇銀行存款或過戶、支票、銀行匯款之客戶，請存款至︰</strong></p><br>';
$body.=	'		<p><strong>銀行存款或過戶</strong><br>';
$body.=	'		收款人名稱：亞洲化粧品企業有限公司</p>';
$body.=	'		<p>中國銀行帳戶號碼：012-692-1-002333-9 (HK$)<br>';
$body.=	'		  恒生銀行帳戶號碼：024-286-5-191478 (HK$)</p>';
$body.=	'		<p>存款後請在存根上註明收件者爲「雅施購物網」、閣下之姓名及訂單編號，傳真至(852)2997-7018或電郵至<a href="mailto:sales@aster.com.hk" onclick="return false;">sales@aster.com.hk</a>。<br>';
$body.=	'		</p><br>';
$body.=	'		<p><strong>支票</strong><br>';
$body.=	'		  只接受「港元」支票。支票抬頭"亞洲化粧品企業有限公司"。<br>';
$body.=	'		  請於支票背面清楚寫上姓名及訂單編號，郵寄至香港九龍新蒲崗大有街34號新科技廣場510-519室，註明雅施購物網收。<br>';
$body.=	'		</p><br>';
$body.=	'		<p><strong>銀行匯款</strong><br>';
$body.=	'		  完成匯款後，請於「銀行匯款收據」上註明收件者爲「雅施購物網」、閣下姓名及訂單編號，傳真至(852)2997-7018或電郵至<a href="mailto:sales@aster.com.hk" onclick="return false;">sales@aster.com.hk</a>。<br>';
$body.=	'		<strong>本公司恕不負責匯款過程中的所有手續費。</strong></p>';
$body.=	'		<p>收款人名稱：亞洲化粧品企業有限公司</p><br>';
$body.=	'		<p><strong>港元戶口</strong><br>';
$body.=	'		  銀行名稱：中國銀行<br>';
$body.=	'		  地址：香港九龍新蒲崗大有街35號<br>';
$body.=	'		  帳戶號碼：012-692-1-002333-9<br>';
$body.=	'		Swift code: BKCHHKHH</p>';
$body.=	'		<p>銀行名稱：恒生銀行<br>';
$body.=	'		  地址：香港九龍尖沙咀加拿芬道18號<br>';
$body.=	'		  帳戶號碼： 024-286-5-191478<br>';
$body.=	'		  Swift code: HASEHKHH</p><br>';
$body.=	'		<p><strong>美元戶口</strong><br>';
$body.=	'		  收款人名稱：亞洲化粧品企業有限公司<br>';
$body.=	'		  入帳銀行：永亨銀行<br>';
$body.=	'		  地址：香港九龍新蒲崗大有街 31號地下B<br>';
$body.=	'		  帳戶號碼：035-813-894701130 (USD)<br>';
$body.=	'		Swift code: WIHBHKHH</p><br>';
$body.=	'		<p><strong>人民幣戶口</strong><br>';
$body.=	'		  銀行名稱：交通銀行 (中山分行)<br>';
$body.=	'		賬戶號碼：622260 0750003 756507 (RMB)</p>';
$body.=	'		<p></p>';
$body.=	'		</td>';
$body.=	'		</tr>';
$body.=	'		</tbody></table></div>';

	Yii::import('application.extensions.phpmailer.JPhpMailer');
$mail = new JPhpMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com:465';
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Username = 'reallypickysp@gmail.com';
$mail->Password = '12345678rr';
$mail->SetFrom('reallypickysp@gmail.com', 'reallypickysp');
$mail->Subject = 'Testing';
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
$mail->CharSet = 'UTF-8';
$mail->MsgHTML($body);
$mail->AddAddress($MemberModel->email, $MemberModel->name);
$mail->Send();

}

public function actionView($id)
{
$user = Yii::app()->session['memberinfo']['id'];
$model = Order::model()->findByAttributes(array('member_id'=>$user,'order_id'=>$id), array('limit'=> 1));
$criteria = new CDbCriteria();
$criteria->condition ="order_id = :t1 and member_id = :t2";
$criteria->params=array(':t1'=>$id, ':t2'=>$user);
$orderItemModel = new OrderItem;
$criteria1 = new CDbCriteria();
$criteria1->addCondition("order_id = :t1");
$criteria1->params[':t1'] = $id;
$products = $orderItemModel->findAll($criteria1);

$shipment_info = new ShipmentInfo;
$criteria2 = new CDbCriteria();
$criteria2->addCondition("destination_country_codes = :t1");
  $country_array = array('HK','TW','MO','CN','AU','US','NZ');
  if(in_array($model->country_code, $country_array)){
    $country_code = $model->country_code;
  }else{
  $country_code = "OO";
  }
$criteria2->params[':t1'] = $country_code;
$info = $shipment_info->findAll($criteria2);




//$model = Order::model()->findAll($criteria);

if($model===null){
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}else{
/*$this->render('view',array(
'model'=>$model,
'products'=>$products,
));*/
$this->render('view',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
'est_day_from'=>$info[0]['est_shipment_days_from'],
'est_day_to'=>$info[0]['est_shipment_days_to'],
'shipment'=>$info[0]['shipment_method'],
));	



	}
}

public function actionCheckout($id)
{
$model=new Member;
$product = new Product;
$orderModel = new Order;
$shipment_info = new ShipmentInfo;
$exchange = ExchangeRate::model()->findByPk(1);
$MemberModel = Member::model()->findByPk(Yii::app()->session['memberinfo']['id']);
$savedInfo = array();
$criteria = new CDbCriteria();
$criteria->addCondition("destination_country_codes = :t1");

if(!Yii::app()->user->isGuest){
  $country_array = array('HK','TW','MO','CN');
  if(!in_array($MemberModel->country_code, $country_array)){
    $country_code = "HK";
  }else{
  $country_code = $MemberModel->country_code;
  }
}else{
  $country_code = "HK";
}
$criteria->params[':t1'] = $country_code;
$info = $shipment_info->findAll($criteria);
$info2 = $shipment_info->findAll();

if(!Yii::app()->user->isGuest){
$savedInfo = array(
'memberaddress'=>$MemberModel->address,
'membertitle'=>$MemberModel->title,
'memberphone'=>$MemberModel->phone,
'memberpostal_code'=>$MemberModel->postal_code,
'membercountry_code'=>$MemberModel->country_code,
'name'=>$MemberModel->name,
'country'=>$MemberModel->country,
'shipment_date'=>$info[0]['est_shipment_days'],
'shipment_cost'=>$info[0]['shipment_cost1'],
'info'=>$info2
//'country_code'=>$MemberModel->
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
'exchange'=>$exchange,
'shipment_date'=>$info[0]['est_shipment_days'],
'shipment_cost'=>$info[0]['shipment_cost1'],
'free_shipment_cost'=>$info[0]['shipment_order_price1'],
'free_shipment_cost_us'=>$info[0]['shipment_order_price2'],
'info'=>$info2
//'orderItemModel'=>$orderItemModel,
));

}
public function actiongetShipmentInfo(){
$ShipmentInfoModel = new ShipmentInfo;
$access = array('HK','TW','MO','CN');
$post = (isset($_POST['Order']['country_code']))?$_POST['Order']['country_code']:"HK";
if(in_array($post, $access)){
  $code = $post;
}else{
  $code = "OO";
}
$criteria = new CDbCriteria();
$criteria->addCondition("destination_country_codes = :t1");
$criteria->params[':t1'] = $code;
$info = $ShipmentInfoModel->findAll($criteria);
$this->renderJSON($info);
}

public function actionPay()
{
$model=new Order;
$orderItemModel = new OrderItem;
//$OrderVerificationCode = new OrderVerificationCode;
//$productModel = new Product;
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);
if(isset($_POST['Order']))
{
$_POST['Order']['member_id']= Yii::app()->session['memberinfo']['id'];
//$_POST['Order']['country_code']= "HK";
$_POST['Order']['order_number']=time();
$OrderVerificationCode = OrderVerificationCode::model()->findByAttributes(
array(
    'isUsed' => 0,
    //'type' => 'user'
),
array(
    //'order' => 'date desc',
    'limit' => 1,
    //'offset' => 15
));

$verification_code = $OrderVerificationCode->code;
if($_POST['Order']['shipment_method'] == "SELF PICKUP"){
$_POST['Order']['verification_code'] = $verification_code;
}else{
  $_POST['Order']['verification_code'] = "";
}

//var_dump($verification_code);
$model->attributes=$_POST['Order'];
//var_dump($_POST['Order']);
$command = Yii::app()->db->createCommand();
if($model->save()){
$product_array = array();
	$totalsum = 0;
	foreach($_POST['product_id'] as $key=>$products){
    if($_POST['quantity'][$key] > 0){

      $currency = $_POST['Order']['total_order_price_currency'];
      $getexchangeRate = ExchangeRate::model()->findByAttributes(array('currency_to'=>$currency));
      $price = Product::model()->findByPk($products)->discount_price;
	$product_name = Product::model()->findByPk($products)->product_name;
      $price = number_format($price*$getexchangeRate->rate, 2, '.', '');
      //echo $price;
      //echo $getexchangeRate->rate;
				$command->reset();
				$result=$command->insert('OrderItem',
				array(
				'order_id'=>$model->order_id,
				'product_id'=>$products,
				//'price'=>$_POST['product_cost'][$key],
        		'price'=>$price,
				'quantity'=>$_POST['quantity'][$key],
				'currency'=>$_POST['Order']['total_order_price_currency']
        
				)
        );
        $totalsum += number_format(($price*$_POST['quantity'][$key]+$_POST['Order']['shipment_cost']), 2, '.', '');
		$product_array[$key] = array('name'=>$product_name,'amount'=>$price,'qty'=>$_POST['quantity'][$key]);
        }

}
//echo $totalsum;
if($_POST['Order']['shipment_method'] == "SELF PICKUP"){
OrderVerificationCode::model()->findByPk($OrderVerificationCode->id)->saveAttributes(array('isUsed'=>'1'));
}
//$OrderVerificationCode->condition="code=".$verification_code;
//$OrderVerificationCode->save();
$model->findByPk($model->order_id)->saveAttributes(array('total_order_price'=>$totalsum));
	//$OrderReference = new OrderReference;
$OrderReference = OrderReference::model()->findByAttributes(array('token'=>Yii::app()->session['token']['token']));
	//$OrderReference->saveAttributes(array('order_id' => $model->order_id));
$MemberModel = Member::model()->findByPk(Yii::app()->session['memberinfo']['id']);
$MemberModel->saveAttributes(array('address' => $_POST['Order']['address'], 'postal_code'=>$_POST['Order']['postal_code'],'country_code'=>$_POST['Order']['country_code'],'phone' => $_POST['Order']['phone'],'title'=>$_POST['Order']['title'],'name'=>$_POST['Order']['name'],'country'=>$_POST['Order']['country']));
//send email function
$this->sendEmail($model->order_id, Yii::app()->session['memberinfo']['id'], $product_array, $totalsum);
$this->redirect(array('payment','id'=>$model->order_id));
}
/*$this->redirect(array('pay','id'=>$model->order_id));*/

}
}

public function actionPayment($id)
{
$user = Yii::app()->session['memberinfo']['id'];
$model = Order::model()->findByAttributes(array('member_id'=>$user,'order_id'=>$id,'order_status'=>1), array('limit'=> 1));
//$model=Order::model()->findByPk($id);
$orderItemModel = new OrderItem;
$criteria = new CDbCriteria();
$criteria->addCondition("order_id = :t1");
$criteria->params[':t1'] = $id;
$products = $orderItemModel->findAll($criteria);
if($model===null){
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}else{
$this->render('payment',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
));
}

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
//$id = Yii::app()->session['memberinfo']['id'];
$id = Yii::app()->session['memberinfo']['id'];
$criteria=new CDbCriteria;
$criteria->condition='member_id ='.$id;
//$criteria->addInCondition('brand_id',$brnd,'AND');
$criteria->order='order_created_date desc';
$dataProvider=new CActiveDataProvider(
  'Order',
  array(
    'criteria'=>$criteria,
    'pagination'=>array(
                'pageSize'=>10,
 ),
    ));
$this->render('index',array(
'dataProvider'=>$dataProvider,
'usersession'=>Yii::app()->session['memberinfo']
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

//$model=Order::model()->findByPk($id);
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
        $member_id = Yii::app()->session['memberinfo']['id'];
          $e=new ExpressCheckout;
	//$orderModel = new Order;
	$orderModel = Order::model()->findByPk($id);
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
 
            $e->setCurrencyCode($orderModel->total_order_price_currency);//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)

            $e->setProducts($products); /* Set array of products*/
 
            $e->setShippingCost($orderModel->shipment_cost);/* Set Shipping cost(Optional) */
 
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
			     /*echo "<pre>";
            print_r($ack);
            echo "</pre>";
			   echo $ack['TOKEN'];*/
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
				$orderModel->saveAttributes(array('order_status' => "2", "order_status_internal"=>"2"));
				$this->redirect(array('order/thankyou','id'=>$PaypalModel->order_id));
			}
            }
 
        }
        public function actionPaypalCancel()
        {  
           //echo $_POST   
          $this->render('cancel');
        }
	public function actionThankyou($id)
	{

$model=Order::model()->findByPk($id);
$orderItemModel = new OrderItem;
$criteria = new CDbCriteria();
$criteria->addCondition("order_id = :t1");
$criteria->params[':t1'] = $id;
$products = $orderItemModel->findAll($criteria);

$shipment_info = new ShipmentInfo;
$criteria = new CDbCriteria();
$criteria->addCondition("destination_country_codes = :t1");

  $country_array = array('HK','TW','MO','CN','AU','US','NZ');
  if(in_array($model->country_code, $country_array)){
    $country_code = $model->country_code;
  }else{
  $country_code = "OO";
  }
$criteria->params[':t1'] = $country_code;
$info = $shipment_info->findAll($criteria);

$this->render('thankyou',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
'est_day_from'=>$info[0]['est_shipment_days_from'],
'est_day_to'=>$info[0]['est_shipment_days_to'],
'shipment'=>$info[0]['shipment_method'],
));
	}
}
