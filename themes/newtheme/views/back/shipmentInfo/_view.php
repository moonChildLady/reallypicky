<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_id')); ?>:</b>
	<?php echo CHtml::encode($data->comp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destination_country')); ?>:</b>
	<?php echo CHtml::encode($data->destination_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_method')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('est_shipmet_days')); ?>:</b>
	<?php echo CHtml::encode($data->est_shipmet_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost1')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_order_price1')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_order_price1); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_order_price_currency_1')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_order_price_currency_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost2')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_order_price2')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_order_price2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_order_price_currency_2')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_order_price_currency_2); ?>
	<br />

	*/ ?>

</div>