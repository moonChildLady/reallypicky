<?php 
$create_date = new DateTime($data->order_created_date);
//$create_date->add(new DateInterval('P$est_dayD'));
$status = array('1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'已送出','6'=>'請與客服聯絡','7'=>'其他');
?>
<a href="/order/<?php echo $data->order_id;?>"><div class="pdtrow clearfix">
	<div class="ofr">
          	訂單編號：<?php echo $data->order_number;?>  訂單狀態：<?php echo $status[$data->order_status];?>
          	<br>
			訂單總額：<?php echo $data->total_order_price_currency;?><?php echo $data->total_order_price;?><br>落單日期：<?php echo $data->order_created_date;?>
    </div>
</div></a>


<!--
		<b><?php echo CHtml::encode($data->getAttributeLabel('order_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->order_id),array('view','id'=>$data->order_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_id')); ?>:</b>
	<?php echo CHtml::encode($data->member_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_status')); ?>:</b>
	<?php echo CHtml::encode($data->order_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_status_internal')); ?>:</b>
	<?php echo CHtml::encode($data->order_status_internal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_method')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost_currency')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost_currency); ?>
	<br />
-->
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postal_code')); ?>:</b>
	<?php echo CHtml::encode($data->postal_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_code')); ?>:</b>
	<?php echo CHtml::encode($data->country_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks_internal')); ?>:</b>
	<?php echo CHtml::encode($data->remarks_internal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_order_price')); ?>:</b>
	<?php echo CHtml::encode($data->total_order_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_order_price_currency')); ?>:</b>
	<?php echo CHtml::encode($data->total_order_price_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_created_date')); ?>:</b>
	<?php echo CHtml::encode($data->order_created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_order_status_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_order_status_update); ?>
	<br />

	*/ ?>
