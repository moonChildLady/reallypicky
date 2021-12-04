<div class="shupper">

      <!-- message Box 1 -->
      <div class="messagebox">
        <div class="title2"><h2>帳戶管理中心</h2></div>
        <div class="pdtrow mtmnp">帳戶資料</div>
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
                        url: "' . Yii::app()->createUrl('member/editpersonal') . '",
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
          <div class="tbl">登入電郵</div>
          <div class="tbr"><?php echo $model->email;?></div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl">  
            <?php echo $form->labelEx($model,'display_name', array('class'=>'control-label')); ?>
          </div>
          <div class="tbr">
          
             <?php echo $form->textField($model,'display_name', array('tabindex'=>'1')); ?>
            <?php echo $form->error($model,'display_name'); ?>
          </div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl"><?php echo $form->labelEx($model,'contact_phone', array('class'=>'control-label')); ?></div>
          <div class="tbr">
            <?php echo $form->textField($model,'contact_phone', array('tabindex'=>'1','type'=>'tel', 'placeholder'=>$model->contact_phone==null ? "你暫時未提供" : "")); ?>
            <?php echo $form->error($model,'contact_phone'); ?>
          </div>
        </div>
        <div class="pdtrow clearfix">
          <div class="tbl"><?php echo $form->labelEx($model,'bill_address', array('class'=>'control-label')); ?></div>
          <div class="tbr">
             <?php 
             echo $form->textArea($model,'bill_address', array('row'=>'4','placeholder'=>$model->bill_address==null ? "你暫時未提供" : "")); ?>
            <?php echo $form->error($model,'bill_address'); ?>
          </div>
        </div>
        <div class="pdtrow">
          <div class="fsblock" align="center">
            <?php echo CHtml::submitButton('提 交',array('class'=>'lbtn','tabindex'=>'5')); ?>
          </div>
        </div>
        <?php $this->endWidget(); ?>
        <?php if ($model->member_type == "NORMAL"){?>
        <div class="pdtrow">
         <div class="pbtn"><a href="/member/changepassword">更改登入密碼</a></div>
        </div>
        <?php } ?>
        <div class="pdtrow mtmnp">配送資料</div>
        <div class="fsblock clearfix">
          <div class="tbl">送貨地址</div>
          <div class="tbr">
            <?php echo $model->name;?> <?php echo $model->title;?><br>
            <?php echo $model->phone;?><br>
            <?php echo $model->address;?>
          </div>
        </div>
        <div class="pdtrow clearfix">
          <div class="tbl">送貨通知</div>
          <div class="tbr"><?php echo $model->email;?></div>
        </div>
        <div class="pdtrow">
         <div class="pbtn"><a href="/member/editdelivery">編輯及更改配送資料</a></div>
        </div>          

        
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