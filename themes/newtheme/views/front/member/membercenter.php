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
    			<div class="tbr"><?php echo $model->display_name;?></div>
				</div>
        <div class="fsblock clearfix">
          <div class="tbl">聯絡電話</div>
    			<div class="tbr"><?php echo $model->contact_phone==null ? "未提供" : $model->contact_phone;?></div>
				</div>
        <div class="pdtrow clearfix">
          <div class="tbl">帳單地址</div>
    			<div class="tbr"><?php echo nl2br($model->bill_address)==null ? "未提供" : nl2br($model->bill_address);?></div>
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
        <div class="pdtrow clearfix">
          <div class="tbl">收貨人</div>
          <div class="tbr"><?php echo $model->title;?> <?php echo $model->name;?></div>
        </div>
        <div class="pdtrow clearfix">
          <div class="tbl">電話 </div>
          <div class="tbr"><?php echo $model->phone;?></div>
        </div>
        <div class="fsblock clearfix">
          <div class="tbl">配送地址</div>
    			<div class="tbr">
          				
						<?php echo nl2br($model->address);?>
					</div>
				</div>
                <div class="pdtrow clearfix">
          <div class="tbl">郵區編號</div>
          <div class="tbr"><?php echo $model->postal_code;?></div>
        </div>
        <div class="pdtrow clearfix">
          <div class="tbl">國家/地區</div>
          <div class="tbr"><?php echo isset($model->countryCode->country_name_chi)?$model->countryCode->country_name_chi:"";?></div>
        </div>
        <?php if($model->country_code == "OO") { ?>
        <div class="pdtrow clearfix">
          <div class="tbl">其他國家</div>
          <div class="tbr"><?php echo $model->country;?></div>
        </div>
        <?php } ?>
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
        <div class="innlink"><a href="/order/">訂單狀態</a></div>
				<div class="mfs">你可以檢視或變更訂單及了解配送狀態。</div>
				<div class="innlink mtmnp"><a href="mailto:reallypicky@aster.com.hk">尋求協助</a></div>
				<div class="mfs">如你需要其他協助請聯絡我們。</div>
			</div>
		    <div class="order">
   		<div class="fbtn"><a href="/">返回活動首頁</a></div>
    </div>

    </div>