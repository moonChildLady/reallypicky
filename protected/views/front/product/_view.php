<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_code')); ?>:</b>
	<?php echo CHtml::encode($data->product_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_name')); ?>:</b>
	<?php echo CHtml::encode($data->product_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_id')); ?>:</b>
	<?php echo CHtml::encode($data->comp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brand_name')); ?>:</b>
	<?php echo CHtml::encode($data->brand_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_desc')); ?>:</b>
	<?php echo CHtml::encode($data->product_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type1')); ?>:</b>
	<?php echo CHtml::encode($data->type1); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price1')); ?>:</b>
	<?php echo CHtml::encode($data->price1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_price1')); ?>:</b>
	<?php echo CHtml::encode($data->discount_price1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency1')); ?>:</b>
	<?php echo CHtml::encode($data->currency1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type2')); ?>:</b>
	<?php echo CHtml::encode($data->type2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price2')); ?>:</b>
	<?php echo CHtml::encode($data->price2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_price2')); ?>:</b>
	<?php echo CHtml::encode($data->discount_price2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency2')); ?>:</b>
	<?php echo CHtml::encode($data->currency2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type3')); ?>:</b>
	<?php echo CHtml::encode($data->type3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price3')); ?>:</b>
	<?php echo CHtml::encode($data->price3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_price3')); ?>:</b>
	<?php echo CHtml::encode($data->discount_price3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency3')); ?>:</b>
	<?php echo CHtml::encode($data->currency3); ?>
	<br />

	*/ ?>

</div>