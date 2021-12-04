
  	<div class="tabs">

			<div class="tab">
				<input type="radio" id="tab-1" name="tab-group-1" checked>
				<label for="tab-1">註 冊</label>
				<div class="content clearfix">
        
        <!-- signup form -->
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<!-- Upper Box -->
    			<div class="fblock clearfix">
          	<div class="tbl">登入電郵</div>
	    			<div class="tbr" data-tip="請以有效的電郵地址作為登入電郵，以確保你能正常收收訂單、付款及配送資料。">
						<!--input id="email" name="email" placeholder="example@domain.com" required type="email" /-->
<?php echo $form->textField($model,'email', array('required'=>'required','type'=>'email', 'placeholder'=>'example@domain.com')); ?>
</div>

          </div>
          <div class="fblock clearfix">
          	<div class="tbl">確認電郵</div>
    				<div class="tbr">
			<!--input id="confirmemail" name="confirmemail" placeholder="確保電郵與上面的一致" required type="email"-->
		<?php echo $form->textField($model,'confirm_email', array('required'=>'required','type'=>'email', 'placeholder'=>'確保電郵與上面的一致')); ?>
			  </div>
          </div>
          <div class="fblock clearfix">
	    			<div class="tbl">顯示名稱</div>
  	  			<div class="tbr">
					
					<!--input id="name" name="name" placeholder="設置聯絡顯示之名稱" required tabindex="1" type="text"-->
			  <?php echo $form->textField($model,'name', array('required'=>'required','type'=>'text', 'placeholder'=>'設置聯絡顯示之名稱')); ?>
			  </div>
          </div>
          <div class="fblock clearfix">
          	<div class="tbl">設置密碼</div>

    				<div class="tbr">
						<!--input type="password" id="password" name="password" placeholder="最少以6個數字及字母的組合" required-->
		<?php echo $form->passwordField($model,'password', array('required'=>'required', 'placeholder'=>'最少以6個數字及字母的組合')); ?>
			  </div>
          </div>
          
          <div class="fblock clearfix" align="center">
          	<!--input name="submit" id="submit" tabindex="5" value="註 冊" type="submit" class="lbtn"-->
			  <?php echo CHtml::submitButton('註 冊', array('tabindex'=>'5','class'=>'lbtn')); ?>
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
					<form id="loginform" action="#">
    			<div class="fblock clearfix" style="margin-top:40px;">
          	<div class="tbl">登入電郵</div>
	    			<div class="tbr"><input id="email" name="email" placeholder="" required type="email"></div>
          </div>

          <div class="fblock clearfix" style="margin-top:20px;">
          	<div class="tbl">密碼</div>
    				<div class="tbr"><input type="password" id="password" name="password" required></div>
          </div>
          
          <div class="fblock clearfix" align="center" style="margin-top:20px;">
          	<input name="submit" id="submit" tabindex="5" value="登 入" type="submit" class="lbtn">
          	<div class="fsbox" align="left"><input name="autologin" type="checkbox" value="yes"> 自動登陸<div style="float:right;"><a href="#">忘記密碼</a></div></div>
          </div>
          </form>
          
				</div> 
			</div>
  
    </div>
    
		<!-- Lower Box -->
    <div class="order">

  		<div class="title2"><h2>確認訂單信息</h2></div>

			<!-- order form -->
      <form id="orderform" action="#">
      
      <!-- product into 1 -->
      <div class="atsp" style="line-height:6px; height:6px;border-bottom:1px dotted #ccc;"></div>
    	<div class="pdtrow clearfix">
	      <div class="oflp">產品</div>
        <div class="ofr" style="width:250px;"><img src="" class="pdtsfoto" />QB<br>日本持久無臭止汗<br>香體膏 6g</div>
      </div>
        
    	<div class="pdtrow clearfix">
      	<div class="oflp">單價</div>
        <div class="ofr">
        	<span class="oprice">HK$88.00</span>
          <span class="hprice">HK$78.00</span>
          <div class="sprice">（含HK$10折扣優惠）</div>
        </div>
      </div>
      
    	<div class="pdtrow clearfix">      
        <div class="oflp">數量</div>
        <div class="ofr"><input type="button" value="-" field="quantity" class="qtyminus" /><input 
      	type="text" name="quantity" value="1" class="qty" /><input 
      	type="button" value="+" field="quantity" class="qtyplus" /></div>
        <div class="pfx">刪除&nbsp;<input type="button" value="x" class="pdtdel"/></div>
      </div>
      
      
      
	    <div class="shipping">貨物配送</div>
      
     	<div class="shrow clearfix">
	      <div class="ofl">國家/地區</div>
  	    <div class="ofr">
        	<select name="destination-id" id="destination-id" class="regionsel">
      			<option value="20" selected>香港</option>
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
    		<div class="ofr">HK$30.00<br>( 多購買<span class="sprice">HK$122.00</span>可免運費 )</div>
      </div>
      
      <div class="total clearfix" style="text-align:right">
				<span>總額 HK$ 108.00</span><br>
				預計送貨日期：約10個工作天
      </div>
      </form>
    </div>