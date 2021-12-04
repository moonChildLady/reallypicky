<?php
$this->breadcrumbs=array(
  'Orders'=>array('index'),
  //$model->name,
);

$create_date = new DateTime($model->order_created_date);
$create_date2 = new DateTime($model->order_created_date);
//$create_date->add(new DateInterval('P$est_dayD'));
$status = array('1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'已送出','6'=>'請與客服聯絡','7'=>'其他');
/*
$this->menu=array(
array('label'=>'List Order','url'=>array('index')),
array('label'=>'Create Order','url'=>array('create')),
array('label'=>'Update Order','url'=>array('update','id'=>$model->order_id)),
array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->order_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Order','url'=>array('admin')),
);*/
?>
<div class="shupper">

      <!-- message Box 1 -->
      <div class="messagebox">
        <div class="title2"><h2>訂單狀態</h2></div>
        
        <div class="pdt2row sfs" align="center">
          訂單編號 <?php echo $model->order_number;?> <span style="padding:0 8px;">|</span> 訂購日期 <?php echo $model->order_created_date;?>
        </div>
        
        <div class="pdtrow clearfix">
          <div class="ofl">狀態</div>
          <div class="ofr"><?php echo $status[$model->order_status];?></div>
        </div>
        
        <div class="pdtrow">
          出貨項目
        </div>
        
        <div class="pdtrow clearfix">
          <div class="ofl">貨件 <?php echo count($products);?> 件</div>

          <?php if($model->shipment_method == "SELF PICKUP"){?>
            <div class="ofr">
            配送方式：自取<br>
            取貨門市：<?php 
            $array = array("銅鑼灣分店","尖沙咀分店","黃大仙分店","太子分店","荃灣分店","屯門分店","元朗分店");
            echo $array[$model->self_pickup_location];
            ;?><br>
<!--            取貨編號：<?php echo $model->verification_code; ?> -->
          </div>
          <?php }else{ ?>
          <div class="ofr">
            可送貨：<?php echo $est_day_from;?>-<?php echo $est_day_to;?> 個工作天<br>

            預計送達：<?php $create_date->modify('+'.$est_day_from.' day'); echo $create_date->format('Y-m-d');?> - <?php $create_date2->modify('+'.$est_day_to.' day');echo $create_date2->format('Y-m-d')?><br>
            配送方式：<?php echo $shipment;?><br>
        <?php if($model->order_status == 5) { ?>
          郵遞公司：<?php echo $model->courier_name;?><br>
          網址：<a href="<?php echo $model->courier_website;?>">'<?php echo $model->courier_website;?>'</a><br>
          貨物追踪號碼：<?php echo $model->courier_tracking_no;?>
          <?php } ?>
          </div>
          <?php } ?>
          
      
        </div>
        
 <?php  foreach($products as $key=>$product) {?>
        <div class="pdtrow clearfix">
          <div class="ofr"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/<?php echo $product->product->image; ?>" class="pdtfoto"  />
          <?php echo $product->product->brand_name;?><?php echo $product->product->product_name;?><br>
          數量 <?php echo $product->quantity;?> 件<br>
          <?php echo ($product->currency == "HKD" ? "HK$":"US$");?> <?php echo $product->price*$product->quantity;?></div>
        </div>
        <?php } ?>

        
        <div class="pdt2row" align="right">
          總額 <?php echo ($model->total_order_price_currency == "HKD" ? "HK$" : "US$");?> <?php echo $totalsum;?>
        </div>
<?php if($model->shipment_method != "SELF PICKUP"){?>
        <div class="pdtrow">
          送貨地址
          <div class="mfs atsp">
            <?php echo $model->title;?> <?php echo $model->name;?><br>
            <?php echo $model->phone;?><br>
            <?php echo nl2br($model->address);?><br><?php echo $model->postal_code;?><br>
            <?php echo ($model->country_code == "OO") ? $model->country :$model->countryCode->country_name_chi;?>

            
          </div>
        </div>

<?php } ?>
<?php if(isset($model->remarks)) { ?>
         <div class="pdtrow">
         備註留言
          <div class="mfs atsp">
            <?php echo nl2br($model->remarks);?>
          </div>
        </div>

<?php } ?>
        <div class="pdtrow">
          送貨通知
          <div class="mfs atsp"><?php echo $model->member->email;?></div>
        </div>
        
        
        
        <div class="fsblock">
          <div class="pbtn"><a href="mailto:reallypicky@aster.com.hk">查詢或協助</a></div>
        </div>
         <?php if($model->order_status == 1){?>
        <!-- repalce if the status payment not finish //start -->

        <div class="fsblock">
          <div class="pbtn"><a href="/order/payment/<?php echo $model->order_id;?>">繼續購買流程</a></div>
        </div>

        <!-- show if the status is payment not finish //end -->
<?php }?>
      </div>

      
      
      
      

    </div>
    
    <!-- Lower Box -->
    <div class="order">
      <div class="fbtn"><a href="/order">返回</a></div>
    </div>

