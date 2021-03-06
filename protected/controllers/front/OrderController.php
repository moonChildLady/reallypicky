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
'actions'=>array('checkout','clear','getShipmentInfo','notice','deliverynote'),
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
public function actionnotice(){
  $this->render('notice');
}
public function actiondeliverynote(){
  $this->render('deliverynote');
}

public function currencySign($sign){
  return ($sign=="HKD") ?"HK$":"US$";
}

/**
* Return Shipment Info model by country code. If country code not found in Shipment Info table, return the Shipment Info where country code = OO
* @param string $code country code
*/
public function getShipmentInfo($code) {
  $shipment_info = new ShipmentInfo;
  $criteria = new CDbCriteria();
  $criteria->addCondition("destination_country_codes = :t1");
  

  $criteria->params[':t1'] = $code;
  $shipmentInfoList = $shipment_info->findAll($criteria);
  if (count($shipmentInfoList) == 0) { // country code not found in Shipment Info, by default get the Shipment Info where country code = "OO"
    $criteria->params[':t1'] = "OO";
    $shipmentInfoList = $shipment_info->findAll($criteria);  
  }
  return $shipmentInfoList[0];
//  $country_array = array('HK','TW','MO','CN','AU','US','NZ');

}


public function EmailSent($body, $email_to, $customer_name, $emailtitle){
	Yii::import('application.extensions.phpmailer.JPhpMailer');
$mail = new JPhpMailer;
$mail->IsSMTP();
$mail->Host = '192.168.110.71';
$mail->SetFrom('reallypicky@aster.com.hk', 'reallypicky');
//$mail->Host = 'smtp.gmail.com:465';
//$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
//$mail->Username = 'reallypickysp@gmail.com';
//$mail->Password = '12345678rr';
//$mail->SetFrom('reallypickysp@gmail.com', 'reallypickysp');
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

public function OrderConfirmationEmail($order_id, $member_id, $products, $totalsum){
$MemberModel = Member::model()->findByPk($member_id);
$orderModel = Order::model()->findByPk($order_id);
$countryModel = CountryCode::model()->findByPK($orderModel->country_code);
$pickuplocation = array("銅鑼灣分店","尖沙咀分店","黃大仙分店","太子分店","荃灣分店","屯門分店","元朗分店");


$body = $this->getEmailContentHeader();

$body .= '  	<table border="0" cellspacing="0" cellpadding="20" width="70%" bgcolor="#ffffff" style="min-width:450px; width:70%; border-radius:6px; margin:6px auto 12px auto;box-shadow:0 1px 4px rgba(104,104,104,0.3);border:1px solid #bbb;">';
$body .= '  	<tr>';
$body .= '    	<td style="font:normal 16px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\' ; color:#555; padding:20px 30px;">';
$body .= '			<div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:10px;color:#6070B8;font-size:26px;line-height:36px;">感謝您的訂購</div>';
$body .= ' 親愛的'.$MemberModel->name.'您好：';


$body .= '<p>「雅施精挑細選購物優惠」已接獲您此次的訂購需求，感謝您對「雅施精挑細選購物優惠」的支持並承蒙訂購，以下資料是您此次的訂購明細，請核對資料并到結賬頁面完成付款手續，以便我們能以最快速度處理您的訂單！付款之前確保您已經閱讀<a href="https://aster.reallypicky.com/order/notice">購物須知</a>，以便我們能夠為您提供滿意的服務。</p>';

$body .= '<div align="center" style="border-top:1px dotted #B0B0B0;border-bottom:1px dotted #B0B0B0; margin-bottom:15px; padding:10px;">';
//$body .= '	<a href="httpss://www.reallypicky.com/order/payment/'.$orderModel->order_id.'">付款頁面</a>';
$body .= '  <a href="https://aster.reallypicky.com/order/'.$orderModel->order_id.'">付款頁面</a>';
$body .= '</div>';
$body .= '<p>如果超過5天我們仍未收到您的款項，該訂單將會被取消。</p>';
$body .= '<br />';
$body .= '<div style="border-bottom:2px solid #CCC; margin-bottom:15px; padding-bottom:6px;"><strong>訂單編號：'.$orderModel->order_number.'</strong></div>';



$body .= '<div style="width:96%; margin:0 auto;">';

$body.='<table width="100%" border="1" cellspacing="0" cellpadding="5"><tbody><tr><td width="70%" align="center"><strong>產品</strong></td><td width="10%" align="center" nowrap><strong>數量</strong></td><td width="10%" align="center" nowrap><strong>價格</strong></td>';
$body.='<td width="10%" align="center"><strong>小計</strong></td></tr>';
foreach($products as $key =>$product){ 
$body.='	<tr><td align="center">'.$product['brand_name'].$product['name'].'</td><td align="center">'.$product['qty'].'</td><td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['amount'],2).'</td><td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['qty']*$product['amount'],2).'</td></tr>';
}
$body.='	<tr><td align="right" colspan="5"><table width="250" border="0" cellspacing="0" cellpadding="0">';
$body.='<tbody><tr>';
$body.='	<td width="50%" height="30" valign="bottom" align="right">運費</td>';
$body.='	<td width="50%" valign="bottom" align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($orderModel->shipment_cost,2).'</td>';
$body.='	</tr>';
$body.='	<tr>';
$body.='	<td align="right">共計</td>';
$body.='	<td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($totalsum,2).'</td>';
$body.='	</tr>';
$body.='    </tbody></table></td>';
$body.='		</tr>';
$body.='		</tbody></table><br>';

$body .= '</div>';

$body .= '<div style="border-bottom:1px solid #CCC; margin-bottom:15px; padding-bottom:6px;"><strong>客戶資料：</strong></div>';
$body .= '<div style="border-bottom:1px solid #CCC; margin-bottom:15px; padding-bottom:6px;">';

$body.='	<table border="0" cellspacing="0" cellpadding="0">';
$body.='	<tr><td>收貨人：</td><td> '.$orderModel->title.' '.$orderModel->name.' </td></tr>';
$body.='	<tr><td>聯絡電話： </td><td>'.$orderModel->phone.' </td></tr>';
//$body.='	<tr><td>貨運方法： </td><td>'.($orderModel->shipment_method == 'BY COURIER' ? '速遞 / 掛號' : '門市自取').'</td></tr>';

$si = $this->getShipmentInfo($orderModel->country_code);
$body.='	<tr><td>貨運方法： </td><td>'.($orderModel->shipment_method == 'BY COURIER' ? $si['shipment_method'] : '門市自取').'</td></tr>';
if($orderModel->shipment_method == 'SELF PICKUP'){ 
	$body.=	'<tr><td>門市地點： </td><td>'.$pickuplocation[$orderModel->self_pickup_location].'</td></tr>';
} else {
    $body.='<tr><td valign="top">收貨地址： </td><td>'.nl2br($orderModel->address).'<br>';
	$body.=$orderModel->postal_code.'<br>';
	$body.=$countryModel->country_name_chi.'<br></td></tr>';
}

$body .= '<tr><td valign="top">備註： </td><td>'.($orderModel->remarks ==null ?'':nl2br($orderModel->remarks)).'</td></tr>';
$body .= '</table>';

$body .= '</div>';

$body .= '<p>「雅施精挑細選購物優惠」保留決定是否接受訂單及出貨與否之權利，付款確認單、出貨以及取貨通知函，將以E-mail方式通知您！</p>';
$body .= '<br />';
$body .= '<p align="right">「雅施精挑細選購物優惠」謹上</p><br />';

$body .= '<p>如有問題，請與我們的客戶服務中心聯絡。</p>';

$body .= '<p style="font-size:18px;color:#6070B8;"><strong>「雅施精挑細選購物優惠」</strong></p>';
//$body .= '香港九龍新蒲崗大有街34號新科技廣場510-519室<br />';
$body .= '客戶服務熱線：(852) 2997-7532<br />';
$body .= '電郵：<a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a>';

$body .= '			</td>';
$body .= '  	</tr>';
$body .= '		</table>';

$body .= $this->getEmailContentFooter();


$title = "您的「雅施精挑細選購物優惠」訂購單(".$orderModel->order_number.")";
$this->EmailSent($body, $MemberModel->email, $MemberModel->name,$title);

}

public function OrderPaymentEmail_internal($order_id, $member_id, $products, $totalsum){
$MemberModel = Member::model()->findByPk($member_id);
$orderModel = Order::model()->findByPk($order_id);
$countryModel = CountryCode::model()->findByPK($orderModel->country_code);
//$productModel = Product::model()->findByPk($products)->discount_price;
$pickuplocation = array("銅鑼灣分店","尖沙咀分店","黃大仙分店","太子分店","荃灣分店","屯門分店","元朗分店");
$body = '<p>親愛的「雅施精挑細選購物優惠」您好：</p>';
$body .='<p>顧客 '.$MemberModel->name.' 已經成功付款，請留意存貨情況以便在顧客付款後對訂單進行及時處理。以下資料是該客戶的訂購明細及聯絡詳情，若有問題則請根據顧客聯繫方式向其查詢，謝謝您！</p>';
$body .='<p>訂單編號：'.$orderModel->order_number.'</p>';

$body.='<table width="100%" border="1" cellspacing="0" cellpadding="5"><tbody><tr><td width="70%" align="center"><strong>產品</strong></td><td width="10%" align="center" nowrap><strong>數量</strong></td><td width="10%" align="center" nowrap><strong>價格</strong></td>';
$body.='<td width="10%" align="center"><strong>小計</strong></td></tr>';
foreach($products as $key =>$product){
$productModel = Product::model()->findByPk($product->product_id);
$body.='	<tr><td align="center">'.$productModel->brand_name.$productModel->product_name.'</td><td align="center">'.$product['quantity'].'</td><td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['price'],2).'</td><td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['quantity']*$product['price'],2).'</td></tr>';
}
$body.='	<tr><td align="right" colspan="5"><table width="250" border="0" cellspacing="0" cellpadding="0">';
$body.='<tbody><tr>';
$body.='	<td width="50%" height="30" valign="bottom" align="right">運費</td>';
$body.='	<td width="50%" valign="bottom" align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($orderModel->shipment_cost,2).'</td>';
$body.='	</tr>';
$body.='	<tr>';
$body.='	<td align="right">共計</td>';
$body.='	<td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($totalsum,2).'</td>';
$body.='	</tr>';
$body.='    </tbody></table></td>';
$body.='		</tr>';
$body.='		</tbody></table><br>';

$body .= '</div>';

$body .= '<div style="border-bottom:1px solid #CCC; margin-bottom:15px; padding-bottom:6px;"><strong>客戶資料：</strong></div>';
$body .= '<div style="border-bottom:1px solid #CCC; margin-bottom:15px; padding-bottom:6px;">';

$body.='	<table border="0" cellspacing="0" cellpadding="0">';
$body.='	<tr><td>收貨人：</td><td> '.$orderModel->title.' '.$orderModel->name.' </td></tr>';
$body.='	<tr><td>聯絡電話： </td><td>'.$orderModel->phone.' </td></tr>';

$si = $this->getShipmentInfo($orderModel->country_code);
$body.='	<tr><td>貨運方法： </td><td>'.($orderModel->shipment_method == 'BY COURIER' ? $si['shipment_method'] :'門市自取'.'</td></tr>');
if($orderModel->shipment_method == 'SELF PICKUP'){ 
	$body.=	'<tr><td>門市地點： </td><td>'.$pickuplocation[$orderModel->self_pickup_location].'</td></tr>';
} else {
    $body.='<tr><td valign="top">收貨地址： </td><td>'.nl2br($orderModel->address).'<br>';
	$body.=$orderModel->postal_code.'<br>';
	$body.=$countryModel->country_name_chi.'<br></td></tr>';
}

$body .= '<tr><td valign="top">備註： </td><td>'.($orderModel->remarks ==null ?'':nl2br($orderModel->remarks)).'</td></tr>';
$body .= '</table>';

$body .='<p>Really Picky謹上</p>';

$title = "訂購單(".$orderModel->order_number.") 顧客已經成功付款";
// $this->EmailSent($body, $MemberModel->email, $MemberModel->name,$title);
$this->EmailSent($body,  'reallypicky@aster.com.hk', 'reallypicky@aster.com.hk',$title);

}

public function OrderPaymentEmail_cutomer($order_id, $member_id, $products, $totalsum){
$MemberModel = Member::model()->findByPk($member_id);
$orderModel = Order::model()->findByPk($order_id);
$countryModel = CountryCode::model()->findByPK($orderModel->country_code);
//$productModel = Product::model()->findByPk($products)->discount_price;
$pickuplocation = array("銅鑼灣分店","尖沙咀分店","黃大仙分店","太子分店","荃灣分店","屯門分店","元朗分店");
$pickupaddress = array("銅鑼灣渣甸街50號渣甸中心地下C號舖 (Tel: 2915 7711)", "尖沙咀加連威老道26號地下 (Tel: 2368 4862)", "黃大仙中心地下高層UG19號舖 (Tel: 2326 1662)", "九龍彌敦道750號始創中心地下29號舖	(Tel: 2625 5100)", "荃灣眾安街68號荃灣城市中心一期地下G8及G75舖	(Tel: 2940 7788)", "屯門時代廣場南翼3樓12號舖 (Tel: 2404 9233)", "元朗青山公路90號地下 (Tel: 2477 6111)");
$openinghours = array("10:30am – 9:30pm","10:00am – 11:30pm","10:30am – 8:30pm","11:00am – 11:00pm","10:30am – 11:00pm","10:00am – 10:00pm","10:00am – 10:00pm");
$create_date = new DateTime($orderModel->order_created_date);
$create_date->modify('+5 day');
$create_date2 = new DateTime('2014-09-07');
//$create_date2->modify('+35 day');

$body = $this->getEmailContentHeader();

$body.='  	<table border="0" cellspacing="0" cellpadding="20" width="70%" bgcolor="#ffffff" ';
$body.='    	style="min-width:450px; width:70%; border-radius:6px; margin:6px auto 12px auto;box-shadow:0 1px 4px rgba(104,104,104,0.3);border:1px solid #bbb;">';
$body.='  	<tr>';
$body.='    	<td style="font:normal 16px/23px  Arial \'Heiti TC\' \'Microsoft JhengHei\' ; color:#555; padding:20px 30px;">';

// ---------------------------------------------  SELF PICKUP -----------------------------------------------------------------------
if($orderModel->shipment_method == 'SELF PICKUP'){ 

$body.='			<div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:6px;color:#6070B8;font-size:26px;line-height:36px;">您訂購的商品已經發貨</div>';

$body.='親愛的'.$MemberModel->name.'您好：';
$body.='<p>「雅施精挑細選購物優惠」現已收到您的付款，感謝您的訂購，請列印此郵件並於收到郵件5日後到您所選擇的雅施分店換領產品。</p>';


$body.='<p align="center" style="color:#6070B8;font-size:20px;"><strong>產品換領憑證</strong></p>';

$body.='<div align="center" style="border:2px solid #999; padding:1px;">';
$body.='<div align="center" style="border:1px solid #999; padding:0;font-size:14px; color:#000;">';

$body.='	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:2px solid #999;">';
$body.='	<tr>';
$body.='		<td width="40%" style="padding:4px 15px"><img src="https://aster.reallypicky.com/images/edm/edm-aster-logo.gif" /></td>';
$body.='		<td width="60%" nowrap="nowrap" align="right" valign="bottom" style="padding:4px 10px;font-size:18px;">';
$body.='  		取貨編號：'.$orderModel->verification_code.'<br />';
$body.='      訂單編號：'.$orderModel->order_number;
$body.='  	</td>';
$body.='	</tr>';
$body.='	</table>';
  
$body.='  <div style="border-bottom:1px solid #999; margin-top:8px; padding:6px 10px; font-size:15px;" align="left"><strong>有效日期：'.$create_date->format('Y年m月d日').'， 換領卷在發出之日起一個月以內有效</strong></div>';
	
		
$img_path = 'https://www.reallypicky.com/themes/newtheme/img/';
foreach($products as $key =>$product){
$productModel = Product::model()->findByPk($product->product_id);
	
$body.='  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #999;">';
$body.='	<tr>';
$body.='		<td width="60" style="padding:4px 10px"><img src="'.$img_path.$productModel->image.'" style="border:1px solid #999;width:50px;height:50px;" /></td>';
$body.='		<td style="padding:4px 10px">'.$productModel->brand_name.$productModel->product_name.' 購買'.$product['quantity'].'件 已付'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['quantity']*$product['price'],2).'<br /></td>';
$body.='	</tr>';
$body.='	</table>';
  
}  
$body.='  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #999; margin-top:12px;">';
$body.='	<tr>';
$body.='		<td width="70" style="padding:4px 10px;">收件人：</td>';
$body.='		<td style="padding:4px 10px">'.$orderModel->title.' '.$orderModel->name.'</td>';
$body.='	</tr>';
$body.='  <tr>';
$body.='		<td style="padding:0 10px" nowrap="nowrap">聯絡電話：</td>';
$body.='		<td style="padding:0 10px">'.$orderModel->phone.'</td>';
$body.='	</tr>';
$body.='  <tr>';
$body.='		<td style="padding:0 10px">商戶名稱：</td>';
$body.='		<td style="padding:0 10px">雅施化粧品中心</td>';
$body.='	</tr>';
$body.='  <tr>';
$body.='		<td valign="top" style="padding:4px 10px">換領地點：</td>';
$body.='		<td style="padding:0 10px">'.$pickuplocation[$orderModel->self_pickup_location].'<br>';
$body.='        '.$pickupaddress[$orderModel->self_pickup_location].'</td>';
$body.='	</tr>';
$body.='  <tr>';
$body.='		<td style="padding:0 10px;padding-bottom:10px;">營業時間：</td>';
$body.='		<td style="padding:0 10px;padding-bottom:10px;">星期一至日('.$openinghours[$orderModel->self_pickup_location].')</td>';
$body.='	</tr>';
$body.='	</table>';

$body.='  <div style="border-bottom:1px solid #999; padding:2px 10px;" align="left">';
$body.='	<p style="font-size:14px;"><strong>如何使用</strong></p>';
$body.='	<ol style="font-size:14px;">';
$body.='		<li>列印換領劵</li>';
$body.='		<li>攜帶並於指定換領地點出示換領劵</li>';
$body.='	<li>商戶有可能向您查詢您於購買換領劵時所登記的手提電話號碼最後4個位數字</li>';
$body.='</ol>';
$body.='</div>';
$body.='<div style="padding:2px 10px;" align="left">';
$body.='<p style="font-size:14px;"><strong>使用條款</strong></p>';
$body.='<ul style="font-size:14px;">';
//$body.='  <li>換領劵有效日期由'.$create_date->format('Y年m月d日').' – '.$create_date2->format('Y年m月d日').'</li>';
$body.='  <li>換領劵有效日期由'.$create_date->format('Y年m月d日').'， 換領卷在發出之日起一個月以內有效</li>';
$body.='	<li>購買時所選定換領地點，不得更改</li>';
$body.='	<li>查詢熱線：2997 7532</li>';
$body.='	<li>此換領劵於網上購買後5天，可到指定地點換領</li>';
$body.='	<li>兌換時必須出示有效之換領劵A4列印本，換領劵將於換領產品時收回</li>';
$body.='	<li>此換領劵只可使用一次，逾期作廢，不得兌換現金，不設退款及延期</li>';
$body.='	<li>此優惠不能與其他優惠或折扣同時使用</li>';
$body.='	<li>如有任何爭議，雅施化粧品中心將保留更改此優惠之權利而毋須另行通知</li>';
$body.='	<li>圖片只供參考，產品顏色或會因電腦螢幕設定差異會略有不同，一切以實物為準</li>';
$body.='</ul>';
$body.='	</div>';



$body.='</div>';
$body.='</div>';

// ---------------------------------------------  BY COURIER  -----------------------------------------------------------------------

} else { 

$body.='			<div align="center" style="border-bottom:1px solid #B0B0B0;margin-bottom:15px;padding-bottom:6px;color:#6070B8;font-size:26px;line-height:36px;">訂單編號：('.$orderModel->order_number.')‏ 已經成功付款</div>';


$body .= ' 親愛的'.$MemberModel->name.'您好：';


$body .= '<p>您已經成功付款。謝謝！</p>';


$body .= '<p>訂單編號：('.$orderModel->order_number.') 您已經成功付款。謝謝！</p>';

$body .= '<div style="width:96%; margin:0 auto;">';

$body.='<table width="100%" border="1" cellspacing="0" cellpadding="5"><tbody><tr><td width="70%" align="center"><strong>產品</strong></td><td width="10%" align="center" nowrap><strong>數量</strong></td><td width="10%" align="center" nowrap><strong>價格</strong></td>';
$body.='<td width="10%" align="center"><strong>小計</strong></td></tr>';
foreach($products as $key =>$product){
$productModel = Product::model()->findByPk($product->product_id);
$body.='	<tr><td align="center">'.$productModel->brand_name.$productModel->product_name.'</td><td align="center">'.$product['quantity'].'</td><td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['price'],2).'</td><td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($product['quantity']*$product['price'],2).'</td></tr>';
}
$body.='	<tr><td align="right" colspan="5"><table width="250" border="0" cellspacing="0" cellpadding="0">';
$body.='<tbody><tr>';
$body.='	<td width="50%" height="30" valign="bottom" align="right">運費</td>';
$body.='	<td width="50%" valign="bottom" align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($orderModel->shipment_cost,2).'</td>';
$body.='	</tr>';
$body.='	<tr>';
$body.='	<td align="right">共計</td>';
$body.='	<td align="right">'.$this->currencySign($orderModel->total_order_price_currency).number_format($totalsum,2).'</td>';
$body.='	</tr>';
$body.='    </tbody></table></td>';
$body.='		</tr>';
$body.='		</tbody></table><br>';

$body .= '</div>';

$body .= '<div style="border-bottom:1px solid #CCC; margin-bottom:15px; padding-bottom:6px;"><strong>客戶資料：</strong></div>';
$body .= '<div style="border-bottom:1px solid #CCC; margin-bottom:15px; padding-bottom:6px;">';

$body.='	<table border="0" cellspacing="0" cellpadding="0">';
$body.='	<tr><td>收貨人：</td><td> '.$orderModel->title.' '.$orderModel->name.' </td></tr>';
$body.='	<tr><td>聯絡電話： </td><td>'.$orderModel->phone.' </td></tr>';


$si = $this->getShipmentInfo($orderModel->country_code);

$body.='	<tr><td>貨運方法： </td><td>'.($orderModel->shipment_method == 'BY COURIER' ? $si['shipment_method']:'門市自取'.'</td></tr>');
if($orderModel->shipment_method == 'SELF PICKUP'){ 
	$body.=	'<tr><td>門市地點： </td><td>'.$pickuplocation[$orderModel->self_pickup_location].'</td></tr>';
} else {
    $body.='<tr><td valign="top">收貨地址： </td><td>'.nl2br($orderModel->address).'<br>';
	$body.=$orderModel->postal_code.'<br>';
	$body.=$countryModel->country_name_chi.'<br></td></tr>';
}

$body .= '<tr><td valign="top">備註： </td><td>'.($orderModel->remarks ==null ?'':nl2br($orderModel->remarks)).'</td></tr>';
$body .= '</table>';

$body .= '</div>';

}

$body.='<br />';
$body.='<p align="right">「雅施精挑細選購物優惠」謹上</p>';

$body.='<p>如有問題，請與我們的客戶服務中心聯絡。</p>';

$body.='<p style="font-size:18px;color:#6070B8;"><strong>「雅施精挑細選購物優惠」</strong></p>';
//$body.='香港九龍新蒲崗大有街34號新科技廣場510-519室<br />';
$body.='客戶服務熱線：(852) 2997-7532<br />';
$body.='電郵：<a href="mailto:reallypicky@aster.com.hk">reallypicky@aster.com.hk</a>';

$body.='			</td>';
$body.='  	</tr>';
$body.='		</table>';

$body.= $this->getEmailContentFooter();

$title = "您的「雅施精挑細選購物優惠」訂購單(".$orderModel->order_number.")已經成功付款";
$this->EmailSent($body, $MemberModel->email, $MemberModel->name,$title);

}

public function actionView($id)
{
$user = Yii::app()->session['memberinfo']['id'];
$model = Order::model()->findByAttributes(array('member_id'=>$user,'order_id'=>$id), array('limit'=> 1));


if($model===null){
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}else{
$criteria = new CDbCriteria();
$criteria->condition ="order_id = :t1 and member_id = :t2";
$criteria->params=array(':t1'=>$id, ':t2'=>$user);
$orderItemModel = new OrderItem;
$criteria1 = new CDbCriteria();
$criteria1->addCondition("order_id = :t1");
$criteria1->params[':t1'] = $id;
$products = $orderItemModel->findAll($criteria1);

$info = $this->getShipmentInfo($model->country_code);

//$model = Order::model()->findAll($criteria);
$this->render('view',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
'est_day_from'=>$info['est_shipment_days_from'],
'est_day_to'=>$info['est_shipment_days_to'],
'shipment'=>$info['shipment_method'],
));	



	}
}

public function actionCheckout($id)
{
Yii::app()->user->setReturnUrl("/".Yii::app()->controller->id."/".Yii::app()->controller->action->id."/".$id);
  //echo Yii::app()->user->returnUrl;
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
$retail_code = array("CB","TST","WTS","PC","TW","TM","YL");
$verification_code = $OrderVerificationCode->code;
if($_POST['Order']['shipment_method'] == "SELF PICKUP"){
$position_location = $_POST['Order']['self_pickup_location'];
//$_POST['Order']['verification_code'] = $verification_code;
$_POST['Order']['verification_code'] = $retail_code[$position_location].$verification_code;
}else{
  $_POST['Order']['self_pickup_location'] = "";
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
	$brand_name =  Product::model()->findByPk($products)->brand_name;
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
        $totalsum += number_format(($price*$_POST['quantity'][$key]), 2, '.', '');
		$product_array[$key] = array('name'=>$product_name,'amount'=>$price,'qty'=>$_POST['quantity'][$key],'brand_name'=>$brand_name);
        }

}
$totalsum = $totalsum+$_POST['Order']['shipment_cost'];
//echo $totalsum;
if($_POST['Order']['shipment_method'] == "SELF PICKUP"){
OrderVerificationCode::model()->findByPk($OrderVerificationCode->id)->saveAttributes(array('isUsed'=>'1'));
}
//$OrderVerificationCode->condition="code=".$verification_code;
//$OrderVerificationCode->save();
$model->findByPk($model->order_id)->saveAttributes(array('total_order_price'=>$totalsum));
if(isset(Yii::app()->session['token'])){
  $OrderReference = new OrderReference;
        $token_list = $OrderReference->findByAttributes(
          array(
              'token' => Yii::app()->session['token']['token'],//where member_id is null, update member_id, else check token, member_id, insert
              'member_id'=> Yii::app()->session['memberinfo']['id']
          ));
          if(is_null($token_list->order_id)){
          Yii::app()->db->createCommand()
            ->update('OrderReference', 
                array(
                    'order_id'=>new CDbExpression($model->order_id),
                    //'total'=>new CDbExpression('total + :ratingAjax', array(':ratingAjax'=>$ratingAjax))
                    'member_id'=>Yii::app()->session['memberinfo']['id'],
                ),
                'token=:token and member_id=:member_id',
                array(
                  ':token'=>Yii::app()->session['token']['token'],
                  ':member_id'=>Yii::app()->session['memberinfo']['id']
                )
            );
          }else{
            //if()//check member, token, order
          $command = Yii::app()->db->createCommand();
          $command->reset();
          $token = array(
            'token'=>Yii::app()->session['token']['token'],
            'product_id'=>Yii::app()->session['token']['product_id'],
            'member_id'=>Yii::app()->session['memberinfo']['id'],
            'order_id'=>$model->order_id
          );
          $result=$command->insert('OrderReference',$token);
          }
        }
$MemberModel = Member::model()->findByPk(Yii::app()->session['memberinfo']['id']);
$MemberModel->saveAttributes(array('address' => $_POST['Order']['address'], 'postal_code'=>$_POST['Order']['postal_code'],'country_code'=>$_POST['Order']['country_code'],'phone' => $_POST['Order']['phone'],'title'=>$_POST['Order']['title'],'name'=>$_POST['Order']['name'],'country'=>$_POST['Order']['country']));
//send email function
$this->OrderConfirmationEmail($model->order_id, Yii::app()->session['memberinfo']['id'], $product_array, $totalsum);
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
	$products[$key] = array('NAME'=>$pt->product->brand_name.$pt->product->product_name,'AMOUNT'=>$pt->price,'QTY'=>$pt->quantity);
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
        $currency = $ack['CURRENCYCODE'];



				$criteria = new CDbCriteria();
				$criteria->addCondition("token = :t1");
				$criteria->params[':t1'] = $token;
				$PaypalModel = PaypalOrder::model()->findByAttributes(array('token'=>$token));
				$PaypalModel->saveAttributes(array('transation_id' => $transation_id, 'transation_date'=>$transation_date,'amount' => $amount,'fee_amount'=>$fee_amount,'payment_status'=>$payment_status, 'currency'=>$currency));

				/*$criteria1 = new CDbCriteria();
				$criteria1->addCondition("order_id = :t1");
				$criteria1->params[':t1'] = $PaypalModel->order_id;*/
				$orderModel = Order::model()->findByAttributes(array('order_id'=>$PaypalModel->order_id));
				$orderModel->saveAttributes(array('order_status' => "2", "order_status_internal"=>"2"));

			$orderItemModel = new OrderItem;
				$criteria1 = new CDbCriteria();
$criteria1->addCondition("order_id = :t1");
$criteria1->params[':t1'] = $PaypalModel->order_id;
$products = $orderItemModel->findAll($criteria1);
$totalsum = $orderModel->total_order_price;

$this->OrderPaymentEmail_cutomer($orderModel->order_id, $orderModel->member_id, $products, $totalsum);

$this->OrderPaymentEmail_internal($orderModel->order_id, $orderModel->member_id, $products, $totalsum);
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

$info = $this->getShipmentInfo($model->country_code);

$this->render('thankyou',array(
'model'=>$model,
'products'=>$products,
'invoice_no'=>$model->order_id,
'totalsum'=>$model->total_order_price,
'cdate'=>$model->order_created_date,
'est_day_from'=>$info['est_shipment_days_from'],
'est_day_to'=>$info['est_shipment_days_to'],
'shipment'=>$info['shipment_method'],
));
	}
}
