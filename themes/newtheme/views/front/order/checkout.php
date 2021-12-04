<?php
/*$user = Yii::app()->facebook->getUser();
if ($user){
//Yii::app()->facebook->setAccessToken($accessToken);
$facebookUserInfo = Yii::app()->facebook->api('/me');
$facebookUser = Yii::app()->facebook->getUser();
$data =  $facebookUserInfo;
 
} else {
    $data = null;
}
 
echo "<pre>"; print_r($data); echo "</pre>";
*/

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
              <?php echo $form->textField($model,'display_name',array('placeholder'=>'設置聯絡顯示之名稱', 'type'=>'text')); ?>
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
            <?php echo CHtml::submitButton('註 冊',array('class'=>'lbtn')); ?>
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
          	<div class="fsbox">用戶點擊註冊的同時，即表示你已閱讀並同意本網站<a href="/member/tnc">服務條款</a>及<a href="/member/privacy">私隱政策</a>。</div>
            
            <div class="fsbox sdline"><b class="wbor">或</b></div>
            <a href="/member/FacebookLogin"><input name="facebook" id="facebook" value="&nbsp; &nbsp; &nbsp; 以Facebook註冊" type="button" class="fbbtn"></a>


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

          	<div class="fsbox" align="left"><input name="autologin" type="checkbox" value="yes"> 自動登陸<div style="float:right;"><a href="/member/forgetpassword">忘記密碼</a></div></div>
            <div class="fsbox sdline"><b class="wbor">或</b></div>
            <a href="/member/FacebookLogin"><input name="facebook" id="facebook" tabindex="5" value="&nbsp; &nbsp; &nbsp; 以Facebook註冊" type="button" class="fbbtn"></a>
          </div>
         <?php $this->endWidget(); ?>

				</div> 
			</div>
  
    </div>
<?php }else { ?>
<script>
    $(document).ready(function(){
      
    });
    </script>
<?php //var_dump(Yii::app()->session['memberinfo']);?>
<div class="welcome" id="afterlogin" style="margin-top:25px;">
      	<h1><?php echo Yii::app()->session['memberinfo']['displayname']; //displayname?></h1>
				<p>您好！歡迎您來到「雅施精挑細選購物優惠」，我們致力於用最高標準為您挑選優質而獨特的商品，讓您隨時隨地體驗網上購物的無窮樂趣。</p>
				<p>如您需要檢視或變更個人資料，可以前往「<a href="/member/membercenter">帳戶管理中心</a>」以查看或更改。</p>
	<!--p><a href="/site/logout">Logout</a></p-->
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

					<?php echo $form->textArea($orderModel,'address',array('row'=>'3','placeholder'=>'送往海外請以英文填寫,每個訂單只限一個收貨地址。', 'value'=>$savedInfo['memberaddress'])); ?>
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
        	<span class="oprice"><span class="currnecy">HK$</span><span id="oprice_<?php echo $key;?>"><?php echo intval($subproduct->price); ?></span></span>
          <span class="hprice"><span class="currnecy">HK$</span><span id="dprice_<?php echo $key;?>"><?php echo $subproduct->discount_price; ?></span></span>
          <div class="sprice">（含<span class="currnecy">HK$</span><span id="dpricediff_<?php echo $key;?>"><?php echo intval($subproduct->price-$subproduct->discount_price); ?></span>折扣優惠）</div>
        </div>
      </div>
      
    	<div class="pdtrow clearfix">      
        <div class="oflp">數量</div>
        <div class="ofr"><input type="button" value="-" field="quantity" class="qtyminus" /><input type="text" name="quantity[]" value="<?php echo (isset($_GET['PT'.$key]))?"1":"0";?>" class="qty" id="qty_<?php echo $key;?>"/><input  type="button" value="+" field="quantity" class="qtyplus" /></div>
      	<input name="product_id[]" value="<?php echo $subproduct->product_id; ?>" type="hidden">
      	<input name="product_cost[]" id="product_cost_<?php echo $key;?>" value="<?php echo $subproduct->discount_price; ?>" type="hidden">
        <input name="cost_diff[]" id="cost_diff_<?php echo $key;?>" value="<?php echo $subproduct->price-$subproduct->discount_price; ?>" type="hidden">
        <input name="dis_cost[]" id="dis_cost_<?php echo $key;?>" value="<?php echo $subproduct->price; ?>" type="hidden">

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

<?php echo $form->dropDownList($orderModel,'shipment_method', 
//array('BY COURIER'=>'速遞 / 掛號','SELF PICKUP'=>'門市自取'), 
array(),
array('class'=>'shippingsel','id'=>'shippingMethod_id'));?>
      		
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
        <span id="shipday_area">預計送貨日期：約<span id="shipday" style="font-size:14px;color:#778088;"></span>個工作天</span>
      </div>
		<?php if(!Yii::app()->user->isGuest) { ?>
		<div class="fblock clearfix" align="center">
			<?php echo CHtml::submitButton('結 帳',array('class'=>'lbtn','id'=>'checkout')); ?>
      </div>
<?php } ?>
<?php if(!Yii::app()->user->isGuest) { ?>
         <?php $this->endWidget(); ?>
<?php } ?>

    </div>
<script type="text/javascript">
$(document).ready(function(){
	var shipment = <?=CJSON::encode($info);?>;
  //var shipment_cost = <?php echo $shipment_cost;?>;//default
  //order/getShipmentInfo
  		var tmp_ship = "";
 		 var free_ship = 0;
      var shipment_cost = 0;
      var htmlCur;
      var total = 0;
      var exchangerate = <?php echo "'".$exchange->rate."'";?>;
      var realexchange = parseFloat(exchangerate);
    	var currency= "";
      var price_org = [];
      var cost_org = [];
      var dis_org = [];
      var  real_ship = "";
      //var shipday = <?php //echo '"'.$savedInfo['shipment_date'].'"';?>;
      var shipday_from = "";
      var shipday_to = "";
      var shipment_method
      $("input[name^=quantity\\[\\]]").attr('readonly', 'readonly');
     $.each($("[id^=product_cost_]"), function(a,b){
        price_org.push($(b).val());
      });
     $.each($("[id^=cost_diff_]"), function(a,b){
        cost_org.push($(b).val());
      });
     $.each($("[id^=dis_cost_]"), function(a,b){
        dis_org.push($(b).val());
      });
     //console.log(dis_org);
	//initchangecountry();
	//$("#countryselect").trigger('change');
	var free_shipment_cost_hk = <?php echo $free_shipment_cost;?>;
      $("#destination").attr('disabled',true);
      $("#pickup_location_area").hide();
      $("#other_country_area").hide();
    $("input[name^=quantity]").bind('keyup', function(){
      recalc();
    });
recalc();
function shipfee(){
	  return <?php echo $shipment_cost;?>;

}
function updateship_cost(){
	
	//console.log("ahdkhaksjd"+tmp_ship);

	if(tmp_ship == 0){
		$("#free").show();
			}else{
		$("#free").hide();
	}
  tmp_ship = parseFloat(tmp_ship);
  $("#shipcost").text(tmp_ship.toFixed(2));
  $("#shipment_cost_").val(tmp_ship.toFixed(2));
}
function get_info(){
	var country_code = ($("#countryselect").val()==null) ? "HK" : $("#countryselect").val();
	var access = ['HK','TW','MO','CN','AU','US','NZ'];
	if($.inArray(country_code, access) == -1){ 
        country_code = "OO";
	}else{
				country_code = ($("#countryselect").val()==null) ? "HK" : $("#countryselect").val();
        
	}
  //console.log("Code: "+country_code);
	$.each(shipment, function(x,y){
		$(y).each(function(a,b){
			/*if(b.destination_country_codes == country_code){
				consol.log(b.shipment_cost1);
			}*/
			$(b).each(function(i,j){
				if(b.destination_country_codes == country_code){
				tmp_ship = b.shipment_cost1;
        real_ship = b.shipment_cost1;
        shipday_from = b.est_shipment_days_from;
        shipday_to = b.est_shipment_days_to;
        shipment_method = b.shipment_method;
        $("#currnecy_").val(b.shipment_order_price_currency_1);
				if(b.shipment_order_price_currency_1 == "HKD"){ //add slef pickup method, rmove option, rewrite option, add hidden filed for shipment_method name in order table
					currency = "HK$";
				}else{
					currency = "US$";
				}
				free_ship = b.shipment_order_price1;
        $("#shipcost").text(parseInt(real_ship));
        $("#shipday").text(shipday_from+"-"+shipday_to);
        //$("#shippingMethod_id").
				}
			});
		});
	});
  $('#shippingMethod_id')
         .append($("<option></option>")
         .attr("value","BY COURIER")
         .text(shipment_method)); 
         $('#shippingMethod_id')
         .append($("<option></option>")
         .attr("value","SELF PICKUP")
         .text("門市自取")); 
$(".currnecy").text(currency);
	  //updateship_cost();
    
}
get_info();



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

    var sum = $this.sum()
	//console.log(sum);
	  //if($("#countryselect").val() == "HK"){
  
  if(sum > 0){
    $("#shipinfo").show();
    $("#free").hide();
    $("#shipcost_diff").text(parseFloat(free_ship-sum).toFixed(2));
  }
  
  //$("#shipcost").text(tmp_ship);
  //console.log(tmp_ship);

	if(sum >= free_ship || $("#shippingMethod_id").val() == "SELF PICKUP"){
		tmp_ship = 0;
    $("#shipinfo").hide();
    $("#free").hide();
		//console.log(free_ship);
	}else{
    tmp_ship = real_ship;
    $("#shipinfo").show();

  }

  
updateship_cost();
  if(sum == 0){
    $("#shipinfo").hide();
   $("#totalPrice").text(
      // round the results to 2 digits
       parseFloat(sum).toFixed(2)
    );
   //$("#checkout").attr('disabled',true);
   $("#total_order_price").val(parseFloat(sum).toFixed(2));
  }else{
    $("#checkout").attr('disabled',false);
    $("#totalPrice").text(
      // round the results to 2 digits
       (parseFloat(sum)+parseFloat(tmp_ship)).toFixed(2)
    );
    $("#total_order_price").val(parseFloat(sum+tmp_ship).toFixed(2));
  }
	  //console.log(free_ship);
	  
    
    
	 
  }

);

}

$("#shippingMethod_id").change(function(){

  if($(this).val()=='SELF PICKUP'){
    $("#pickup_location_area").show();
    tmp_ship = 0;
	   //$("#shipment_cost_").val(0);
     //$("#shipcost").text(tmp_ship);
	  }else{
    $("#pickup_location_area").hide();
	   tmp_ship = real_ship;
	 }
   //$("#shipcost").text(tmp_ship);
   console.log(tmp_ship);
//updateship_cost();
console.log(tmp_ship);
recalc();
});

	$("#countryselect").change(function(){
    
		var access = ['HK','TW','MO','CN','AU','US','NZ'];
    get_info();
    $("#shippingMethod_id").empty();
    	if($.inArray($(this).val(), access) > -1){
		//if(access.index($(this).val()) == -1){
      $("#destination").val($(this).val());
		
		//$("#destination").val($(this).val());
      if($(this).val()=="HK"){
		  //change currency here
        //$("#shippingMethod_id").attr('disabled',false);
        $('#shippingMethod_id')
         .append($("<option></option>")
         .attr("value","BY COURIER")
         .text(shipment_method)); 
         $('#shippingMethod_id')
         .append($("<option></option>")
         .attr("value","SELF PICKUP")
         .text("門市自取")); 
        //$("#shippingMethod_id").attr('disabled', false);
        //$("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", false);
        //$("#shippingMethod_id option[value='BY\ COURIER']").attr("disabled", false);
      }else{
        $('#shippingMethod_id')
         .append($("<option></option>")
         .attr("value","BY COURIER")
         .text(shipment_method)); 
		  //$("#shippingMethod_id").val("BY COURIER");
        //$("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", true);
      }
    }else{
      console.log("#destination:"+$(this).val());
    $("#destination").val('OO');
    /*  $("#shippingMethod_id").attr('disabled', false);
      $("#shippingMethod_id option[value='SELF\ PICKUP']").attr("disabled", true);
     $("#shippingMethod_id option[value='BY\ COURIER']").attr("disabled", false);*/
     $('#shippingMethod_id')
         .append($("<option></option>")
         .attr("value","BY COURIER")
         .text(shipment_method)); 
    }

    //$("#shippingMethod_id").val(0);
    $("#pickup_location_area").hide();
	if($(this).val() =="OO"){
  		$("#other_country_area").show();
		}else{
  	$("#other_country_area").hide();
		}
	/*var price_current = $("[id^=dprice_]").text();
  var price_org  = $("[id^=product_cost]").val();*/
  
  $.each($("[id^=dprice_]"), function(a,b){
    if(currency=="US$"){
      price = parseFloat(price_org[a]*exchangerate);
    }else{
      price = parseFloat(price_org[a]);
    }
    console.log(price);
    $(b).text(
      price.toFixed(2)
    );

  });

  $.each($("[id^=dpricediff_]"), function(a,b){
    if(currency=="US$"){
      price = parseFloat(cost_org[a]*exchangerate).toFixed(2);
    }else{
      price = cost_org[a];
    }
    //console.log(price);
    $(b).text(
      price
      );

  });
$.each($("[id^=oprice_]"), function(a,b){
    if(currency=="US$"){
      price = parseFloat(dis_org[a]*exchangerate).toFixed(2);
      
    }else{
      price = dis_org[a];
      
    }
    $(b).text(
      price
    );
    console.log(price);
    
  });


  //cost_org

		/*if(currency=="US$"){yt0
			price = price*exchangerate;
		}else{
			price = price/exchangerate;
		}*/

	
	recalc();
	});
	<?php if(!Yii::app()->user->isGuest) { ?>
	$("#countryselect").val(<?php echo "'".$savedInfo['membercountry_code']."'";?>).trigger('change');
	<?php }else{ ?>
    $("#countryselect").val('HK').trigger('change');
	<?php } ?>

//qtyminus
//qtyplus
$(".qtyminus").click(function(){
  var elm = $(this).parent().children('.qty');
  var val = elm.val();
val = Number(val) == NaN ? 0 : Number(val);
if(Number(elm.val())>0){
// Benson's comment: don't know why after added the jquery-mmenu js in main.php, this function will call twice. rewrite to add 0.5 each time to prevent this issue for the moment
elm.val(val - 0.5);
}
$("input[name^=quantity]").keyup();
recalc();
});


$(".qtyplus").click(function(){
  var elm = $(this).parent().children('.qty');
  var val = elm.val();
  //defau = 33;
val = Number(val) == NaN ? 0 : Number(val);
// Benson's comment: don't know why after added the jquery-mmenu js in main.php, this function will call twice. rewrite to add 0.5 each time to prevent this issue for the moment
elm.val(val + 0.5);
$("input[name^=quantity]").keyup();
recalc();
});

});
</script>
    


