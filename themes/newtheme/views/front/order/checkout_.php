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
              <?php echo $form->textField($model,'email',array('placeholder'=>'example@domain.com', 'type'=>'email')); ?>
			<?php echo $form->error($model,'email'); ?>

            </div>
          </div>
          <div class="fblock clearfix">
          	<div class="tbl"><?php echo $form->labelEx($model,'confirmemail', array('class'=>'control-label')); ?></div>
    				<div class="tbr">
              <!--input id="confirmemail" name="confirmemail" placeholder="確保電郵與上面的一致" required type="email"-->
              <?php echo $form->textField($model,'confirmemail',array('placeholder'=>'確保電郵與上面的一致', 'type'=>'email')); ?>
		<?php echo $form->error($model,'confirmemail'); ?>
            </div>
          </div>
          <div class="fblock clearfix">
	    			<div class="tbl"><?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?></div>
  	  			<div class="tbr">
              <!--input id="name" name="name" placeholder="設置聯絡顯示之名稱" required tabindex="1" type="text"-->
              <?php echo $form->textField($model,'name',array('placeholder'=>'設置聯絡顯示之名稱', 'type'=>'text','tabindex'=>'1')); ?>
					<?php echo $form->error($model,'name'); ?>
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
	   'action'=>$this->createUrl('/member/login'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    			<div class="fblock clearfix" style="margin-top:40px;">
          	<div class="tbl"><?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?></div>
	    			<div class="tbr">
						<!--input id="email" name="email" placeholder="" required type="email"-->
						<?php echo $form->textField($model,'email',array('type'=>'email')); ?>
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
<?php //echo var_dump(Yii::app()->session['memberinfo']);?>
<div class="welcome" id="afterlogin" style="margin-top:25px;">
      	<h1><?php echo Yii::app()->session['memberinfo']['name'];?> 歡迎您再次回來！</h1>
				<p>在這𥚃，你會發現叫人驚喜產品，讓你便意選購。你再次到來，我們感到非常高興！</p>
				<p>如您需要檢視或變更個人資料，可以前往「<a href="#">帳戶管理中心</a>」以查看或更改。</p>
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
					<?php echo $form->textField($orderModel,'title',array('placeholder'=>'先生')); ?>
					<?php echo $form->error($orderModel,'title'); ?>
		 </div>
				</div>

        <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'name', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'name',array('placeholder'=>'送往海外請以英文填寫')); ?>
					<?php echo $form->error($orderModel,'name'); ?>
			</div>
				</div>
        <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'phone', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'phone',array('type'=>'tel')); ?>
					<?php echo $form->error($orderModel,'phone'); ?>
			</div>
				</div>
<div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'address', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'address',array('placeholder'=>'送往海外請以英文填寫')); ?>
					<?php echo $form->error($orderModel,'address'); ?>
			</div>
				</div>
	<div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'postal_code', array('class'=>'control-label')); ?></div>
    			<div class="tbr">

					<?php echo $form->textField($orderModel,'postal_code'); ?>
					<?php echo $form->error($orderModel,'postal_code'); ?>
			</div>
				</div>
	

	<div class="pdtrow clearfix">
          <div class="tbl"><?php echo $form->labelEx($orderModel,'country_code', array('class'=>'control-label')); ?></div>
    			<div class="tbr">
					<?php echo $form->dropDownList($model,'country_code', CHtml::listData(CountryCode::model()->findAll(), 'country_code', 'country_name_eng'), array('class'=>'regionsel'));?>
					<?php echo $form->error($orderModel,'country_code'); ?>
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
        <div class="ofr" style="width:250px;"><img src="" class="pdtsfoto" />QB<br><?php echo $subproduct->product_name; ?></div>
      </div>
        
    	<div class="pdtrow clearfix">
      	<div class="oflp">單價</div>
        <div class="ofr">
        	<span class="oprice">HK$<?php echo $subproduct->price; ?></span>
          <span class="hprice">HK$<?php echo $subproduct->discount_price; ?></span>
          <div class="sprice">（含HK$<?php echo $subproduct->price-$subproduct->discount_price; ?>折扣優惠）</div>
        </div>
      </div>
      
    	<div class="pdtrow clearfix">      
        <div class="oflp">數量</div>
        <div class="ofr"><input type="button" value="-" field="quantity" class="qtyminus" /><input 
      	type="text" name="quantity[]" value="0" class="qty" /><input 
      	type="button" value="+" field="quantity" class="qtyplus" /></div>
      	<input name="product_id[]" value="<?php echo $subproduct->product_id;?>" type="hidden">
      	<input name="product_cost[]" value="<?php echo $subproduct->discount_price;?>" type="hidden">
        <!--div class="pfx">刪除&nbsp;<input type="button" value="x" class="pdtdel"/></div-->
      </div>

<?php } ?>

		 <div class="shipping">貨物配送</div>
      
     	<div class="shrow clearfix">
	      <div class="ofl">國家/地區</div>
  	    <div class="ofr">
        	<select name="destination-id" id="destination-id" class="regionsel">
      			<option value="20">香港</option>
      		</select>
      	</div>
      </div>

     	<div class="shrow clearfix">
	      <div class="ofl">方式</div>
        <div class="ofr">
      		<select name="shippingMethod_id" id="shippingMethod_id" class="shippingsel">
      			<option value="1">速遞 / 掛號</option>
        		<option value="2">門市自取</option>
      		</select>
        </div>
      </div>

			<div class="shrow clearfix">
      	<div class="ofl">運費</div>
    		<div class="ofr">HK$0.00<br>( 免運費 )</div>
      </div>
      <div class="total clearfix" style="text-align:right">
        <span>總額 <span id="totalPrice">HK$0</span></span><br>
        預計送貨日期：約10個工作天
      </div>
		<div class="fblock clearfix" align="center">
			<?php echo CHtml::submitButton('結 帳',array('class'=>'lbtn','tabindex'=>'5')); ?>

      </div>

<?php if(!Yii::app()->user->isGuest) { ?>
         <?php $this->endWidget(); ?>
<?php } ?>

    </div>
    <script>
    $(function(){

    });
    </script>
