
<div class="tabs" id="tabtop">
      <div class="tab">
        <input type="radio" id="tab-1" name="tab-group-1" checked>
        <label for="tab-1">忘記密碼</label><span> </span>
        <div class="content">
        
          <!-- login form -->
  <?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'check-form',
  'enableClientValidation'=>true,
  'clientOptions'=>array(
    'validateOnSubmit'=>true,
  ),
)); ?>

          <div class="fblock clearfix" style="margin-top:40px;">
            <div class="tbl"><?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?></div>
            <div class="tbr">
            <!--input id="email" name="email" placeholder="" required type="email"-->
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
          </div>
          </div>
          
          <div class="fblock clearfix" style="margin-top:40px;">
            <div class="tbl"><?php echo $form->labelEx($model,'confirmpassword', array('class'=>'control-label')); ?></div>
            <div class="tbr">
            <!--input id="email" name="email" placeholder="" required type="email"-->
            <?php echo $form->passwordField($model,'confirmpassword'); ?>
            <?php echo $form->error($model,'confirmpassword'); ?>
          </div>
          </div>
          <div class="fblock clearfix" align="center" style="margin-top:20px;">
<?php echo CHtml::submitButton('確 定',array('class'=>'lbtn','tabindex'=>'5')); ?>

          </div>
         <?php $this->endWidget(); ?>

        </div> 
      </div>
  
    </div>