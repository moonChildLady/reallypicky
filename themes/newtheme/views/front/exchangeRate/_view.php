<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_from')); ?>:</b>
	<?php echo CHtml::encode($data->currency_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_to')); ?>:</b>
	<?php echo CHtml::encode($data->currency_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />


</div>