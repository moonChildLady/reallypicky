<div class="shupper">

    	<!-- message Box 1 -->
			<div class="messagebox">
      	
        <div class="pdtrow">
      		<h1 align="center">你的訂單已成功創建<br>正等待付款...</h1>
        </div>
        
				<div class="pdtrow">
        	<h3>温馨提示</h3>				
        	<p>訂單資料已發送到你登入郵箱：<br>
					<?php echo $model->member->email;?></p>
					<p>如你遇上問題需要協助請到<a href="mailto:reallypicky@aster.com.hk">這裡</a>。</p>
       	</div>
				<p>如需要檢視或變更訂單，可到「<a href="/member/membercenter">帳戶管理中心</a>」的「<a href="/order">訂單狀態</a>」以查看或更改。</p>

			</div>
      
      <!-- message Box 2 -->
			<div class="messagebox">
      	<div class="title2"><h2>訂單信息</h2></div>
        <div class="pdtrow">
        	<p>訂單編號 <?php echo $model->order_number;?><br>訂購日期 <?php echo $cdate;?></p><br>
        </div>
        <div class="total" style="text-align:right">
        	<span>總額 <?php echo ($model->total_order_price_currency=="HKD") ? "HK$":"US$";?> <?php echo $totalsum;?></span>
        </div>
			</div>
      
    </div>

	 <div class="order">
  		<div class="title2"><h2>選擇付款方式</h2></div>
      <div class="inner">
<div class="pbtn"><a href="/Order/RequestPayment/<?php echo $invoice_no;?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/paypal.png" width="200" height="70"><br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/credit.png" width="200" height="70"><br>PayPal或信用卡付款</a></div>
      </div>
    </div>


