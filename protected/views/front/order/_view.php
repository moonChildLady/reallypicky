<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost_currency')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<?php /*
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
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

</div>