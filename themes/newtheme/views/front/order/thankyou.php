<?php 
$create_date = new DateTime($model->order_created_date);
$create_date2 = new DateTime($model->order_created_date);
//$create_date->add(new DateInterval('P$est_dayD'));
?>
<div class="shupper">

    	<!-- message Box 1 -->
			<div class="messagebox">
      
      	<div class="pdtrow">
      		<h1 align="center">感謝你的訂購</h1>
          <div class="mfs" align="center">我們會將以下訂單資料發送到你的郵箱</div>
        </div>
        
        <div class="pdt2row sfs" align="center">
        	訂單編號 <?php echo $model->order_number;?> <span style="padding:0 8px;">|</span> 訂購日期 <?php echo $model->order_created_date;?>
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
            取貨編號：<?php echo $model->verification_code; ?>
          </div>
          <?php }else{ ?>
        	<div class="ofr">
          	可送貨：<?php echo $est_day_from;?>-<?php echo $est_day_to;?> 個工作天<br>
						預計送達：<?php $create_date->modify('+'.$est_day_from.' day'); echo $create_date->format('Y-m-d');?> - <?php $create_date2->modify('+'.$est_day_to.' day');echo $create_date2->format('Y-m-d')?><br>
          	配送方式：<?php echo $shipment;?>
          </div>
          <?php } ?>
        </div>
        <?php	foreach($products as $key=>$product) {?>
				<div class="pdtrow clearfix">
					<div class="ofr"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/<?php echo $product->product->image; ?>" class="pdtfoto"  />
          <?php echo $product->product->brand_name;?><?php echo $product->product->product_name;?><br>
					數量 <?php echo $product->quantity;?> 件<br>
					<?php echo ($product->currency=="HKD")?"HK$":"US$";?> <?php echo $product->price*$product->quantity;?></div>
        </div>
        <?php } ?>
        <div class="pdt2row" align="right">
        	總額 <?php echo ($model->total_order_price_currency=="HKD"?"HK$":"US$");?> <?php echo $totalsum;?>
        </div>
        
        <?php if($model->shipment_method != "SELF PICKUP"){?>
        <div class="pdtrow">
          送貨地址
          <div class="mfs atsp">
            <?php echo $model->title;?> <?php echo $model->name;?><br>
            <?php echo $model->phone;?><br>
            <?php echo nl2br($model->address);?><br><?php echo $model->postal_code;?><br>
            <?php echo ($model->country_code == "OO")? $model->country :$model->countryCode->country_name_chi;?>
            <?php //echo $model->country;?> 
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
				送貨通知
				<div class="mfs atsp"><?php echo $model->member->email;?></div>
        
			</div>
        
      <!-- message Box 2 -->
			<div class="messagebox">
      	常見問題
				<div class="mfs atsp">如需要了解何時會收到產品，檢視或變更訂單，可到「<a href="/member/membercenter">帳戶管理中心</a>」的「<a href="/order">訂單狀態</a>」查看最新的狀態。</div>
			</div>
      
      <div class="fbtn"><a href="/">返回活動首頁</a></div>
      <br>
      
    </div>