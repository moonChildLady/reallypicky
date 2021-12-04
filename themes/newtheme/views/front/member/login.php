<div class="tabs" id="tabtop">

			<div class="tab">
				<input type="radio" id="tab-1" name="tab-group-1" checked>
				<label for="tab-1">註 冊</label>
				<div class="content clearfix">
        
        <!-- signup form -->

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
      'enableAjaxValidation'=>true,
        'action'=>$this->createUrl('member/Reg'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
    'validateOnSubmit'=>true,
  ),

));*/
   ?>
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
				<?php echo $form->labelEx($member,'email', array('class'=>'control-label')); ?>
			</div>
	    			<div class="tbr" data-tip="請以有效的電郵地址作為登入電郵，以確保你能正常收收訂單、付款及配送資料。">
              <!--input id="email" name="email" placeholder="example@domain.com" required type="email" /-->
              <?php echo $form->emailField($member,'email',array('placeholder'=>'example@domain.com', 'type'=>'email')); ?>
			<?php echo $form->error($member,'email'); ?>

            </div>
          </div>
          <div class="fblock clearfix">
          	<div class="tbl"><?php echo $form->labelEx($member,'confirmemail', array('class'=>'control-label')); ?></div>
    				<div class="tbr">
              <!--input id="confirmemail" name="confirmemail" placeholder="確保電郵與上面的一致" required type="email"-->
              <?php echo $form->emailField($member,'confirmemail',array('placeholder'=>'確保電郵與上面的一致', 'type'=>'email')); ?>
		<?php echo $form->error($member,'confirmemail'); ?>
            </div>
          </div>
          <div class="fblock clearfix">
	    			<div class="tbl"><?php echo $form->labelEx($member,'display_name', array('class'=>'control-label')); ?></div>
  	  			<div class="tbr">
              <!--input id="name" name="name" placeholder="設置聯絡顯示之名稱" required tabindex="1" type="text"-->
              <?php echo $form->textField($member,'display_name',array('placeholder'=>'設置聯絡顯示之名稱', 'type'=>'text')); ?>
					<?php echo $form->error($member,'display_name'); ?>
            </div>
          </div>
          <div class="fblock clearfix">
          	<div class="tbl"><?php echo $form->labelEx($member,'password', array('class'=>'control-label')); ?></div>
    				<div class="tbr">
              <!--input type="password" id="password" name="password" placeholder="最少以6個數字及字母的組合" required-->
              <?php echo $form->passwordField($member,'password',array('placeholder'=>'最少以6個數字及字母的組合')); ?>
						<?php echo $form->error($member,'password'); ?>
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
          	<div class="fsbox">用戶點擊註冊的同時，即表示你已閱讀並同意本網站<a href="/member/tnc">服務條款</a>及<a href="/member/privacy">私隱政策</a>。</div>
            
            <div class="fsbox sdline"><b class="wbor">或</b></div>
            <a href="/member/FacebookLogin"><input name="facebook" id="facebook" value="&nbsp; &nbsp; &nbsp; 以Facebook註冊" type="button" class="fbbtn"></a>
          </div>
		<?php $this->endWidget(); ?>

				</div>
			</div>
        
			<div class="tab">
				<input type="radio" id="tab-2" name="tab-group-1" <?php echo ($url=='/')?"":"checked"?>>
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
								window.location.href="'.$url.'";
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