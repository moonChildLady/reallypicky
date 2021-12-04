<?php

?>
<?php if(Yii::app()->user->isGuest) { ?>

<div class="tabs" id="tabtop">

			<div class="tab">
				<input type="radio" id="tab-1" name="tab-group-1" checked>
				<label for="tab-1">註 冊</label>
				<div class="content clearfix">
        
        <!-- signup form -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
      'enableAjaxValidation'=>true,
        'action'=>$this->createUrl('member/Reg'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
    'validateOnSubmit'=>true,
  ),

));
   ?>

<!-- Upper Box -->

    			<div class="fblock clearfix">
          	<div class="tbl">
				<?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
			</div>
	    			<div class="tbr" data-tip="請以有效的電郵地址作為登入電郵，以確保你能正常收收訂單、付款及配送資料。">
              <!--input id="email" name="email" placeholder="example@domain.com" required type="email" /-->
              <?php echo $form->emailField($model,'email',array('placeholder'=>'example@domain.com', 'type'=>'email')); ?>
			<?php echo $form->error($model,'email'); ?>

            </div>
          </div>
          <div class="fblock clearfix">
          	<div class="tbl"><?php echo $form->labelEx($model,'confirmemail', array('class'=>'control-label')); ?></div>
    				<div class="tbr">
              <!--input id="confirmemail" name="confirmemail" placeholder="確保電郵與上面的一致" required type="email"-->
              <?php echo $form->emailField($model,'confirmemail',array('placeholder'=>'確保電郵與上面的一致', 'type'=>'email')); ?>
		<?php echo $form->error($model,'confirmemail'); ?>
            </div>
          </div>
          <div class="fblock clearfix">
	    			<div class="tbl"><?php echo $form->labelEx($model,'display_name', array('class'=>'control-label')); ?></div>
  	  			<div class="tbr">
              <!--input id="name" name="name" placeholder="設置聯絡顯示之名稱" required tabindex="1" type="text"-->
              <?php echo $form->textField($model,'display_name',array('placeholder'=>'設置聯絡顯示之名稱', 'type'=>'text','tabindex'=>'1')); ?>
					<?php echo $form->error($model,'display_name'); ?>
            </div>
          </div>
          <div class="fblock clearfix">
          	<div class="tbl"><?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?></div>
    				<div class="tbr">
              <!--input type="password" id="password" name="password" placeholder="最少以6個數字及字母的組合" required-->
              <?php echo $form->passwordField($model,'password',array('placeholder'=>'最少以6個數字及字母的組合')); ?>
						<?php echo $form->error($model,'password'); ?>
            </div>
          </div>
          
          <div class="fblock clearfix" align="center">
          	<!--input name="submit" id="submit" tabindex="5" value="註 冊" type="submit" class="lbtn"-->
            <?php echo CHtml::submitButton('註 冊',array('class'=>'lbtn','tabindex'=>'5')); ?>
			 <?php /*echo CHtml::ajaxSubmitButton('註 冊',CHtml::normalizeUrl(array('member/Reg')),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         console.log(data);
                    }',                    
                     'beforeSend'=>'function(){                        
                           $("#AjaxLoader").show();
                      }'
                     ),array('class'=>'lbtn','tabindex'=>'5'));*/ ?>
          	<div class="fsbox" style="float:left;">用戶點擊註冊的同時，即表示你已閱讀並同意本網站<a href="#">服務條款</a>及<a href="#">隱私條款</a>。</div>
          </div>
		<?php $this->endWidget(); ?>

				</div>
			</div>
        
			<div class="tab">
				<input type="radio" id="tab-2" name="tab-group-1">
				<label for="tab-2">登 入</label><span> </span>
				<div class="content">
        
        	<!-- login form -->
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
'enableClientValidation'=>true,
	 //'action'=>$this->createUrl('/member/login'),
	'clientOptions' => array(
            'validateOnSubmit' => true,
            'afterValidate' => 'js:function(form, data, hasError) {
                if (!hasError){
                    str = $("#login-form").serialize();

                    $.ajax({
                        type: "POST",
                        url: "' . Yii::app()->createUrl('/member/login') . '",
                        data: str,
                        dataType: "json",
                        beforeSend : function() {
                           // $("input[name=yt0]").attr("disabled",true);
                        },
                        success: function(data) {
                            if(data.success == "fail"){
							alert("登入失敗");
							}else{
								window.location.href=window.location.href;
							}
                        },
                    });
                    return false;
                }
            }',
        ),
)); ?>

    			<div class="fblock clearfix" style="margin-top:40px;">
          	<div class="tbl"><?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?></div>
	    			<div class="tbr">
						<!--input id="email" name="email" placeholder="" required type="email"-->
						<?php echo $form->emailField($model,'email'); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
          </div>

          <div class="fblock clearfix" style="margin-top:20px;">
          	<div class="tbl"><?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?></div>
    				<div class="tbr"><?php echo $form->passwordField($model,'password'); ?>
						<?php echo $form->error($model,'password'); ?></div>
          </div>
          
          <div class="fblock clearfix" align="center" style="margin-top:20px;">
<?php echo CHtml::submitButton('登 入',array('class'=>'lbtn','tabindex'=>'5')); ?>

          	<div class="fsbox" align="left"><input name="autologin" type="checkbox" value="yes"> 自動登陸<div style="float:right;"><a href="#">忘記密碼</a></div></div>
          </div>
         <?php $this->endWidget(); ?>

				</div> 
			</div>
  
    </div>
<?php }else { ?>
<script>
    $(document).ready(function(){
      var shipday = <?php echo '"'.$savedInfo['shipment_date'].'"';?>;
      
      //$("#countryselect").val(membercountry_code).trigger('change');
      $("#shipday").text(shipday);
    });
    </script>
<?php //echo var_dump(Yii::app()->session['memberinfo']);?>
<div class="welcome" id="afterlogin" style="margin-top:25px;">
      	<h1><?php echo Yii::app()->session['memberinfo']['name'];?> 歡迎您再次回來！</h1>
				<p>在這𥚃，你會發現叫人驚喜產品，讓你便意選購。你再次到來，我們感到非常高興！</p>
				<p>如您需要檢視或變更個人資料，可以前往「<a href="/member/membercenter">帳戶管理中心</a>」以查看或更改。</p>
	<p><a href="/site/logout">Logout</a></p>
		</p>
	</p>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
'enableClientValidation'=>true,
	   'action'=>$this->createUrl('/order/Pay'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="shipinfo">

      	<div class="title2"><h2>填寫配送資料</h2></div>
        <div class="pdtrow clearfix">收貨人</div>

	 <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'title', array('class'=>'control-label')); ?></div>
    			<div class="tbr">
					<?php echo $form->textField($orderModel,'title',array('placeholder'=>'先生','value'=>$savedInfo['membertitle'])); ?>
					<?php echo $form->error($orderModel,'title'); ?>
		 </div>
				</div>

        <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'name', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'name',array('placeholder'=>'送往海外請以英文填寫','value'=>$savedInfo['name'])); ?>
					<?php echo $form->error($orderModel,'name'); ?>
			</div>
				</div>
        <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'phone', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'phone',array('type'=>'tel','value'=>$savedInfo['memberphone'])); ?>
					<?php echo $form->error($orderModel,'phone'); ?>
			</div>
				</div>
<div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'address', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textArea($orderModel,'address',array('row'=>'3','placeholder'=>'送往海外請以英文填寫', 'value'=>$savedInfo['memberaddress'])); ?>
					<?php echo $form->error($orderModel,'address'); ?>
			</div>
				</div>



	<div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'postal_code', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'postal_code', array('value'=>$savedInfo['memberpostal_code'])); ?>
					<?php echo $form->error($orderModel,'postal_code'); ?>
			</div>
				</div>

	<div class="pdtrow clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'country_code', array('class'=>'control-label')); ?></div>
    			<div class="tbr">
					<?php echo $form->dropDownList($orderModel,'country_code', CHtml::listData(CountryCode::model()->findAll(array("condition"=>"status='ACTIVE'", 'order'=>'ordering_chi')), 'country_code', 'country_name_chi'), array('class'=>'regionsel','options'=>array($savedInfo['membercountry_code']=>array('selected'=>'true')), 'id'=>'countryselect'
           /* ,'ajax' => array(
'type'=>'POST', //request type
'url'=>CController::createUrl('order/getShipmentInfo'), //url to call.
//Style: CController::createUrl('currentController/methodToCall')
//'update'=>'#city_id', //selector to update
'data'=>'js:jQuery(this).serialize()',
'success'=>'function(data) {
    $.each(data.info, function(x,y){

//      shipment_cost = y.shipment_cost1;
      //defau = y.shipment_cost1;
  //    shipment_order_price1 = y.shipment_order_price1;

      $("#shipday").text(y.est_shipment_days);
	  //recalc();

    });
}',
)*/
));?>
					<?php echo $form->error($orderModel,'country_code'); ?>
			</div>
				</div>


      <div class="fsblock clearfix" id="other_country_area">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'country', array('class'=>'control-label')); ?></div>
          <div class="tbr">
          <?php echo $form->textField($orderModel,'country',array('value'=>$savedInfo['country'])); ?>
          <?php echo $form->error($orderModel,'country'); ?>
      </div>
        </div>

			<div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'remarks', array('class'=>'control-label')); ?></div>
    			<div class="tbr">
					<?php echo $form->textArea($orderModel,'remarks', array('rows'=>'3','placeholder'=>'可留空')); ?>
					<?php echo $form->error($orderModel,'remarks'); ?>
			</div>
				</div>


      </div>
<?php } ?>
		<!-- Lower Box -->
    <div class="order">

      <div class="title2"><h2>確認訂單信息</h2></div>

      <!-- order form -->

      
      <?php foreach($subproducts as $key=>$subproduct) { ?>
	<?php //echo $subproduct->product_name; ?><br>

      <!-- product into 1 -->
      <div class="atsp" style="line-height:6px; height:6px;border-bottom:1px dotted #ccc;"></div>
    	<div class="pdtrow clearfix">
	      <div class="oflp">產品</div>
        <div class="ofr" style="width:250px;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/<?php echo $subproduct->image; ?>" class="pdtsfoto" />QB<br><?php echo $subproduct->product_name; ?></div>
      </div>
        
    	<div class="pdtrow clearfix">
      	<div class="oflp">單價</div>
        <div class="ofr">
        	<span class="oprice"><span class="currnecy">HK$</span><span id="oprice_<?php echo $key;?>"><?php echo $subproduct->price; ?></span></span>
          <span class="hprice"><span class="currnecy">HK$</span><span id="dprice_<?php echo $key;?>"><?php echo $subproduct->discount_price; ?></span></span>
          <div class="sprice">（含<span class="currnecy">HK$</span><span id="dpricediff_<?php echo $key;?>"><?php echo $subproduct->price-$subproduct->discount_price; ?></span>折扣優惠）</div>
        </div>
      </div>
      
    	<div class="pdtrow clearfix">      
        <div class="oflp">數量</div>
        <div class="ofr"><input type="button" value="-" field="quantity" class="qtyminus" /><input type="text" name="quantity[]" value="0" class="qty" id="qty_<?php echo $key;?>"/><input  type="button" value="+" field="quantity" class="qtyplus" /></div>
      	<input name="product_id[]" value="<?php echo $subproduct->product_id; ?>" type="hidden">
      	<input name="product_cost[]" id="product_cost_<?php echo $key;?>" value="<?php echo $subproduct->discount_price; ?>" type="hidden">

			<input name="total_<?php echo $key;?>" value="" type="hidden">
        <!--div class="pfx">刪除&nbsp;<input type="button" value="x" class="pdtdel"/></div-->
      </div>

<?php } ?>

		 <div class="shipping">貨物配送</div>
      
     	<div class="shrow clearfix">
	      <div class="ofl">國家/地區</div>
  	    <div class="ofr">
          <?php echo $form->dropDownList($orderModel,'destination', CHtml::listData(ShipmentInfo::model()->findAll(), 'destination_country_codes', 'destination_name'), array('class'=>'shippingsel','id'=>'destination'));?>
      	</div>
      </div>



     	<div class="shrow clearfix">
	      <div class="ofl">方式</div>
        <div class="ofr">

<?php echo $form->dropDownList($orderModel,'shipment_method', array('BY COURIER'=>'速遞 / 掛號','SELF PICKUP'=>'門市自取'), array('class'=>'shippingsel','id'=>'shippingMethod_id'));?>
      		
        </div>
      </div>

        <div class="shrow clearfix" id="pickup_location_area">
        <div class="ofl">門市地點</div>
        <div class="ofr">
<?php echo $form->dropDownList($orderModel,'self_pickup_location', array("銅鑼灣分店","尖沙咀分店","黃大仙分店","太子分店","荃灣分店","屯門分店","元朗分店"), array('class'=>'shippingsel','id'=>'pickup_location'));?>
          
        </div>
      </div>


			<div class="shrow clearfix">
      	<div class="ofl">運費</div>
    		<div class="ofr"><span class="currnecy">HK$</span><span id="shipcost"></span><br><span id="shipinfo" style="display:none">( 多購買 <span class="currnecy">HK$</span><span id='shipcost_diff'></span>可免運費 )</span><span id="free" style="display:none">( 免運費 )</span></div>

      </div>
      <div class="total clearfix" style="text-align:right">
<?php echo $form->hiddenField($orderModel,'shipment_cost',array( 'id'=>'shipment_cost_','value'=>'0')); ?>
<?php echo $form->hiddenField($orderModel,'total_order_price',array( 'id'=>'total_order_price')); ?>
<?php echo $form->hiddenField($orderModel,'total_order_price_currency',array( 'id'=>'currnecy_')); ?>
<?php echo $form->hiddenField($orderModel,'shipment_cost_currency',array( 'id'=>'currnecy_ship')); ?>
        <span>總額 <span class="currnecy">HK$</span><span id="totalPrice">0.00</span></span><br>
        <span id="shipday_area">預計送貨日期：約<span id="shipday" style="font-size:14px;color:#778088;">10</span>個工作天</span>
      </div>
		<?php if(!Yii::app()->user->isGuest) { ?>
		<div class="fblock clearfix" align="center">
			<?php echo CHtml::submitButton('結 帳',array('class'=>'lbtn','tabindex'=>'5')); ?>

      </div>
<?php } ?>
<?php if(!Yii::app()->user->isGuest) { ?>
         <?php $this->endWidget(); ?>
<?php } ?>

    </div>
    <script type="text/javascript">

$(document).ready(function(){
  var defau = 0;
  //order/getShipmentInfo
  var shipment_order_price1 = 0;
      var shipment_cost = 0;
      var htmlCur;
      var total = 0;
      var exchangerate = <?php echo "'".$exchange->rate."'";?>;
      var realexchange = parseFloat(exchangerate);
      $("#destination").attr('disabled',true);
      $("#pickup_location_area").hide();
      $("#other_country_area").hide();
    $("input[name^=quantity]").bind('keyup', function(){
      recalc();
    });
    
    
<?php //if(!Yii::app()->user->isGuest) { ?>
$.ajax({
'type':'POST',
'url':'/order/getShipmentInfo',
'data':$("#countryselect").serialize(),
'success':function(data) {
$.each(data.info, function(x,y){
 shipment_cost = y.shipment_cost1;
//defau = y.shipment_cost1;
 shipment_order_price1 = y.shipment_order_price1;
$("#shipday").text(y.est_shipment_days);
$("#shipcost").text(y.shipment_cost1);

if($("#countryselect").val()!="HK"){
$("[id^=dprice_]").each(function(i,j){
  var oprice = $(j).text();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).text(newprice.toFixed(2));
  //$("input[name='product_cost\\[\\]'']").eq(i).val(newprice.toFixed(2));
  //$(".currnecy").text("US$");
  //dprice_
  }
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).text(Math.ceil(newprice));
  //$("input[name='product_cost\\[\\]'']").eq(i).val(newprice.toFixed(2));
  //$(".currnecy").text("HK$");
  //dprice_
}
});

$("[id^=dpricediff_]").each(function(i,j){
  var oprice = $(j).text();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).text(newprice.toFixed(2));
  
  //dprice_
}
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).text(Math.ceil(newprice));
  //dprice_
}
});
//
$("[id^=product_cost_]").each(function(i,j){
  var oprice = $(j).val();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).val(newprice.toFixed(2));
  //dprice_
}
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).val(Math.ceil(newprice));
  
}
console.log($(j).val());
});
$("[id^=oprice_]").each(function(i,j){
  var oprice = $(j).text();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).text(newprice.toFixed(2));
  $(".currnecy").text("US$");
  $("#currnecy_, #currnecy_ship").val("USD");
  //dprice_
}
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).text(Math.ceil(newprice));
  $(".currnecy").text("HK$");
  $("#currnecy_, #currnecy_ship").val("HKD");
  //dprice_
}
});
$("#currnecy_, #currnecy_ship").val("USD");
}else{
  $("#currnecy_, #currnecy_ship").val("HKD");
}

 if($("#countryselect").val() =="OO"){
    $("#other_country_area").show();
    $("#currnecy_, #currnecy_ship").val("USD");
}
});
/*if($("#countryselect").val()=="HK"){
      $("#shippingMethod_id").attr('disabled',false);
    }*/
    //SELF PICKUP BY COURIER
  var access = ['HK','TW','MO','CN'];
    if($.inArray($("#countryselect").val(), access) != -1){  
      $("#destination").val($(this).val());
      if($("#countryselect").val()=="HK"){
        //$("#shippingMethod_id").attr('disabled',false);
        $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", false);
        $("#shippingMethod_id option[value='BY\ COURIER']").attr("disabled", false);
      }else{
        $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", true);
      }
    }else{
      $("#destination").val('OO');
      $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", true);
      $("#shippingMethod_id option[value='BY\ COURIER']").attr("disabled", false);
    }
    //$("#shippingMethod_id").val(0);
    $("#pickup_location_area").hide();
recalc();
},
'cache':false
});
<?php //} ?>


$("#countryselect").change(function(){

$.ajax({
'type':'POST',
'url':'/order/getShipmentInfo',
'data':$(this).serialize(),
'success':function(data) {
$.each(data.info, function(x,y){
 shipment_cost = y.shipment_cost1;
 shipment_order_price1 = y.shipment_order_price1;
$("#shipday").text(y.est_shipment_days);

$("[id^=product_cost_]").each(function(i,j){
  var oprice = $(j).val();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).val(newprice.toFixed(2));
  //dprice_
}
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).val(Math.ceil(newprice));
  
}
console.log($(j).val());
});

$("[id^=dprice_]").each(function(i,j){
  var oprice = $(j).text();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).text(newprice.toFixed(2));
  //$(".currnecy").text("US$");
  //dprice_
  }
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).text(Math.ceil(newprice));
  //$(".currnecy").text("HK$");
  //dprice_
}
});

$("[id^=dpricediff_]").each(function(i,j){
  var oprice = $(j).text();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).text(newprice.toFixed(2));
  
  //dprice_
}
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).text(Math.ceil(newprice));
  //dprice_
}
});




$("[id^=oprice_]").each(function(i,j){
  var oprice = $(j).text();
  if(y.shipment_order_price_currency_1 == "USD"){
if($(".currnecy").eq(0).text()!="US$"){
  var newprice = parseFloat(oprice)*realexchange;
  $(j).text(newprice.toFixed(2));
  $("#currnecy_, #currnecy_ship").val("USD");
  $(".currnecy").text("US$");
  
  //dprice_
}
}else{
  var newprice = parseFloat(oprice)/realexchange;
  $(j).text(Math.ceil(newprice));
  $(".currnecy").text("HK$");
  $("#currnecy_, #currnecy_ship").val("HKD");
  
  //dprice_
}
});


});
recalc();
},
'cache':false
});


    var access = ['HK','TW','MO','CN'];
    if($.inArray($("#countryselect").val(), access) != -1){  
      $("#destination").val($(this).val());
      if($(this).val()=="HK"){
        //$("#shippingMethod_id").attr('disabled',false);
        $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", false);
        $("#shippingMethod_id option[value='BY\ COURIER']").attr("disabled", false);
      }else{
        $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", true);
      }
    }else{
      $("#destination").val('OO');
      $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", true);
     $("#shippingMethod_id option[value='BY\ COURIER']").attr("disabled", false);
    }
    //$("#shippingMethod_id").val(0);
    $("#pickup_location_area").hide();

if($(this).val()=="OO"){
  $("#other_country_area").show();
}else{
  $("#other_country_area").hide();
}

});

$("#shippingMethod_id").change(function(){
  
  if($(this).val()=='SELF PICKUP'){
    $("#pickup_location_area").show();
    defau = 0;
    $("#shipcost").text(
    parseInt(defau).toFixed(2)
    )
    $("#shipday_area").hide();
  }else{
    $("#pickup_location_area").hide();
    $("#shipday_area").show();
    defau = shipment_cost;
  }

  $("#shipcost").text(
    parseInt(defau).toFixed(2)
    );
  $("#shipment_cost_").val(
    defau
    );
  //shipment_cost_recalc();
  //recalc();

  

});





function recalc(){
$("input[name^=total_]").calc(
  // the equation to use for the calculation
  "qty * price",
  // define the variables used in the equation, these can be a jQuery object
  {
    qty: $("input[id^=qty_]"),
    price: $("[id^=dprice_]")
  },
  // define the formatting callback, the results of the calculation are passed to this function
  function (s){
    // return the number as a dollar amount
    return s.toFixed(2);
  },
  // define the finish callback, this runs after the calculation has been complete
  function ($this){
    // sum the total of the $("[id^=total_item]") selector
    if($("#shippingMethod_id").val()=="SELF PICKUP"){
      defau = 0;

    }else{
      defau = parseFloat(shipment_cost);
    }

    if($this.sum() > 0 ){
    if($this.sum() >= shipment_order_price1){
      defau = 0;
      $("#shipcost").text(defau.toFixed(2));
      console.log(defau);
      if($("#shippingMethod_id").val()!="SELF PICKUP"){
      $("#free").show;
      }
    }else{
      var diff = (shipment_order_price1 - $this.sum());
      $("#shipcost").text(defau.toFixed(2));
      $("#free").hide();
      $("#shipcost_diff").text(parseFloat(diff).toFixed(2));

    }
    }

    if($this.sum() == 0){
      $("#free").hide();
      defau = 0;
    }
    
    //$("#shipment_cost_").val(defau);
    var sum = $this.sum()+defau;
    $("#totalPrice").text(
      // round the results to 2 digits
       sum.toFixed(2)
    );
    $("#total_order_price").val(sum.toFixed(2));

    $("#shipcost").text(
    parseInt(defau).toFixed(2)
    );

    if(defau==0){
      $("#shipinfo").hide();
      if($this.sum() > 0){
      $("#free").show();
      }  
      /*$("#shipcost").text(
    parseInt(shipment_cost).toFixed(2)
    );*/
    }else{
      $("#shipinfo").show();
    }
    if(total == 0){
      $("#shipcost").text(
    parseInt(shipment_cost).toFixed(2)
    );
      //$("input[name=yt0]").attr('disabled',true);
    }else{
      //$("input[name=yt0]").attr('disabled',false);
    }

    
  }
  
);

}
function shipment_cost_recalc(){
  
  $("input[name=quantity\\[\\]]").each(function(x,y){
  
  if($(y).val() >= 1){
    total = 1;
  }
  if($(y).val() == 0){
    total = 0;
  }
  });
console.log(total);
  
  if(total == 0){
    
    //defau = 0;
    $("#shipment_cost_").val(defau.toFixed(2));
    $("#shipinfo").hide();
    
  }else{
    defau = parseInt(shipment_cost);
    $("#shipment_cost_").val(defau);

  }
  recalc();

}
//qtyminus
//qtyplus
$(".qtyminus").click(function(){
  
  var elm = $(this).parent().children('.qty');
  
  var val = elm.val();
val = Number(val) == NaN ? 0 : Number(val);
if(Number(elm.val())>0){
elm.val(val - 1);
}
$("input[name^=quantity]").keyup();
shipment_cost_recalc();
});


$(".qtyplus").click(function(){
  var elm = $(this).parent().children('.qty');
  var val = elm.val();
  //defau = 33;
val = Number(val) == NaN ? 0 : Number(val);
elm.val(val + 1);
$("input[name^=quantity]").keyup();
shipment_cost_recalc();
});
});
</script>
    


