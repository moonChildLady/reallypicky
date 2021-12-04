<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>


<div class="shupper">
      <div class="messagebox">
        <?php if($id == '1'){?>
        <div class="mfs">此電郵已被註冊</div>
        <?php } ?>
      </div>
</div>

    <div class="order">
      <div class="fbtn"><a href="/">返回活動首頁</a></div>
    </div>
