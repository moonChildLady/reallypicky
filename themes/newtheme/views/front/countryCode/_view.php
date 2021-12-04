<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('country_code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->country_code),array('view','id'=>$data->country_code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_name_eng')); ?>:</b>
	<?php echo CHtml::encode($data->country_name_eng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_name_chi')); ?>:</b>
	<?php echo CHtml::encode($data->country_name_chi); ?>
	<br />


</div>