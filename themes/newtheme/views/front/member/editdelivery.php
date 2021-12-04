<div class="shupper">

      <!-- message Box 1 -->
      <div class="messagebox">
        <div class="title2"><h2>帳戶管理中心</h2></div>
        <div class="pdtrow mtmnp">帳戶資料</div>
        <div class="fsblock clearfix">
          <div class="tbl">登入電郵</div>
          <div class="tbr"><?php echo $model->email;?></div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl">帳戶名稱</div>
          <div class="tbr"><?php echo $model->name;?></div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl">聯絡電話</div>
          <div class="tbr"><?php echo $model->contact_phone==null ? "未提供" : $model->contact_phone;?></div>
        </div>
        <div class="pdtrow clearfix">
          <div class="tbl">帳單地址</div>
          <div class="tbr"><?php echo $model->bill_address==null ? "未提供" : $model->bill_address;?></div>
        </div>
        <div class="pdtrow">
          <div class="pbtn"><a href="/member/editpersonal">編輯及更改個人資料</a></div>
        </div>
        <?php if ($model->member_type == "NORMAL"){?>
        <div class="pdtrow">
         <div class="pbtn"><a href="/member/changepassword">更改登入密碼</a></div>
        </div>
        <?php } ?>
        <div class="pdtrow mtmnp">配送資料</div>
        <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'member-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'afterValidate' => 'js:function(form, data, hasError) {
                if (!hasError){
                    str = $("#member-form").serialize() + "&ajax=member-form";

                    $.ajax({
                        type: "POST",
                        url: "' . Yii::app()->createUrl('member/editdelivery') . '",
                        data: str,
                        dataType: "json",
                        beforeSend : function() {
                            $("input[name=yt0]").attr("disabled",true);
                        },
                        success: function(data) {
                            if(data.status == 1)
                            {
                               alert("已成功!");
                               window.location.href= "/member/membercenter";
                            }
                            else
                            {
                             alert("failed!");
                            }
                            $("input[name=yt0]").attr("disabled",false);
                            //$("form")[0].reset()
                        },
                    });
                    return false;
                }
            }',
        ),
    ));
    ?>
            <div class="fsblock clearfix">
          <div class="tbl">
            <?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?></div>
          <div class="tbr">
            <!--textarea id="address" name="address" value="" placeholder="" cols="" rows="3" required>九龍長沙灣長好街328號，好彩邨彩長樓19樓A室</textarea-->
            <?php echo $form->textField($model,'title', array('tabindex'=>'1','row'=>'3','cols'=>'')); ?>
            <?php echo $form->error($model,'title'); ?>
          </div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl">
            <?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?></div>
          <div class="tbr">
            <!--textarea id="address" name="address" value="" placeholder="" cols="" rows="3" required>九龍長沙灣長好街328號，好彩邨彩長樓19樓A室</textarea-->
            <?php echo $form->textField($model,'name', array('tabindex'=>'1','row'=>'3','cols'=>'')); ?>
            <?php echo $form->error($model,'name'); ?>
          </div>
        </div>
                <div class="fsblock clearfix">
          <div class="tbl">
            <?php echo $form->labelEx($model,'phone', array('class'=>'control-label')); ?></div>
          <div class="tbr">
            <!--textarea id="address" name="address" value="" placeholder="" cols="" rows="3" required>九龍長沙灣長好街328號，好彩邨彩長樓19樓A室</textarea-->
            <?php echo $form->textField($model,'phone', array('tabindex'=>'1','row'=>'3','cols'=>'')); ?>
            <?php echo $form->error($model,'phone'); ?>
          </div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl">
            <?php echo $form->labelEx($model,'address', array('class'=>'control-label')); ?></div>
          <div class="tbr">
            <!--textarea id="address" name="address" value="" placeholder="" cols="" rows="3" required>九龍長沙灣長好街328號，好彩邨彩長樓19樓A室</textarea-->
            <?php echo $form->textArea($model,'address', array('tabindex'=>'1','row'=>'3','cols'=>'')); ?>
            <?php echo $form->error($model,'address'); ?>
          </div>
        </div>
        
        <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($model,'postal_code', array('class'=>'control-label')); ?></div>
          <div class="tbr">
             <?php echo $form->textField($model,'postal_code'); ?>
            <?php echo $form->error($model,'postal_code'); ?>
          </div>
        </div>
        
        <div class="pdtrow clearfix">
          <div class="tbl"><?php echo $form->labelEx($model,'country_code', array('class'=>'control-label')); ?></div>
          <div class="tbr">
            <?php echo $form->dropDownList($model,'country_code', CHtml::listData(CountryCode::model()->findAll(array("condition"=>"status='ACTIVE'", 'order'=>'ordering_chi')), 'country_code', 'country_name_chi'), array('class'=>'regionsel','options'=>array($model->country_code=>array('selected'=>'true')), 'id'=>'countryselect'));?>
            <?php echo $form->error($model,'country_code'); ?>
          </div>
        </div>

      <div class="pdtrow clearfix" id="other_country_area">
          <div class="tbl">
            <?php echo $form->labelEx($model,'country', array('class'=>'control-label')); ?></div>
          <div class="tbr">
          <?php echo $form->textField($model,'country'); ?>
          <?php echo $form->error($model,'country'); ?>
      </div>
        </div>


        <div class="pdtrow">
          <div class="fsblock" align="center">
            <?php echo CHtml::submitButton('提 交',array('class'=>'lbtn','tabindex'=>'5')); ?>
          </div>
        </div>         
<?php $this->endWidget(); ?>
        
      </div>
      
      
      
      <!-- message Box 2 -->
      <div class="messagebox">
        <div class="innlink"><a href="/order">訂單狀態</a></div>
        <div class="mfs">你可以檢視或變更訂單及了解配送狀態。</div>
        <div class="innlink mtmnp"><a href="mailto:reallypicky@aster.com.hk">尋求協助</a></div>
        <div class="mfs">如你需要其他協助請聯絡我們。</div>
      </div>
        <div class="order">
      <div class="fbtn"><a href="/">返回活動首頁</a></div>
    </div>

    </div>
    <script type="text/javascript">
      $(function(){
        if($("#countryselect").val() =="OO"){
    $("#other_country_area").show();
    //$("#currnecy_, #currnecy_ship").val("USD");
    }else{
      $("#other_country_area").hide();
    }
  $("#countryselect").change(function(){
    if($(this).val() =="OO"){
    $("#other_country_area").show();
    //$("#currnecy_, #currnecy_ship").val("USD");
    }else{
      $("#other_country_area").hide();
    }
  });
});
    </script>