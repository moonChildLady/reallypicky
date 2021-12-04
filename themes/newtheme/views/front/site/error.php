<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<!--h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div-->

<div class="shupper">
      <div class="messagebox">
        <div class="mfs">網頁未找到 <span>:(</span></div>
        <p>抱歉，你所嘗試訪問的網頁並不存在。</p>
        <p>此結果有可能是因為：</p>
        <ul>
                <li>網址輸入錯誤</li>
                <li>該鏈接已經失效</li>
            </ul>
      </div>
</div>

    <div class="order">
      <div class="fbtn"><a href="/">返回活動首頁</a></div>
    </div>
