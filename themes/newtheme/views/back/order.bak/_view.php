<?php

$criteria = new CDbCriteria();
$criteria->addCondition("order_id = :t1");
$criteria->params[':t1'] = $data->order_id;
$OrderItems = OrderItem::model()->findAll($criteria);

?>
<?php $box = $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Order No:'.CHtml::link(CHtml::encode($data->order_id),array('view','id'=>$data->order_id)).' Name: '.CHtml::encode($data->member->email).' ['.CHtml::encode($data->member->name).'] Order Date: '.CHtml::encode($data->order_created_date),
		'context' => 'primary',
        'headerIcon' => 'th-list',
    	'padContent' => false,

        'htmlOptions' => array(
			'class' => 'bootstrap-widget-table',

		),

    )
);?>
<div class="row">
	<div class="col-md-9">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
			<th>Type</th>
            <th>Quan.</th>
            <th>sub-total</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($OrderItems as $key=>$OrderItem) { ?>
	<tr>
		<td width="10%">
			<?php //echo $OrderItem->id;?>
			<?php echo $key+1;?>
		</td>
		<td>
			<div class="row">
				<div class="col-md-4">
					<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/testing.jpg', $OrderItem->product->product_name,array('class'=>'img-responsive img-thumbnail', 'title'=>$OrderItem->product->product_name)); //.$OrderItem->product->image?>
					</div>
				<div class="col-md-8">
				<?php echo $OrderItem->product->product_name;?>
					</div>
		</td>
		<td>
			<?php //echo $OrderItem->type;?> 
		</td>
		<td>
			<?php     $this->widget(
	    'booster.widgets.TbBadge',
	    array(
	    'context' => 'success',
	    // 'default', 'success', 'info', 'warning', 'danger'
	    'label' => $OrderItem->quantity.'件',
	    )
    	);?>
    	<td>
			<?php echo $OrderItem->currency;?> . <?php echo $OrderItem->price;?> 
		</td>
	</tr>
		<?php } ?>
        </tbody>
    </table>
	</div>
	<div class="col-md-3">

		<div>
			For Customer:<br>
			<?php echo CHtml::dropDownList('customer'.$data->order_id, 'customer',array('1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'己送出','6'=>'請與客服聯絡','7'=>'其他'),
  array(
    'prompt'=>'Select Status',
	 'options'=>array($data->order_status=>array('selected'=>'true')),
	  //array('options' => array('2'=>array('selected'=>true))));
    'ajax' => array(
    'type'=>'POST', 
    'url'=>Yii::app()->createUrl('/backend.php/order/CustomerUpdateStatus'), //or $this->createUrl('loadcities') if '$this' extends CController
    //'update'=>'#city_name', //or 
	'success' => 'function(data){
		alert("Updated!")
	}',
  	'data'=>array('id'=>'js:this.value','order_id'=>$data->order_id),
  ))); ?>
		</div>
<div>
			For Internal:<br>
			<?php echo CHtml::dropDownList('internal'.$data->order_id, 'internal',array('1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'己送出','6'=>'與客人聯絡中','7'=>'取消','8'=>'其他'),
  array(
    'prompt'=>'Select Status',
	 'options'=>array($data->order_status_internal=>array('selected'=>'true')),
	  //array('options' => array('2'=>array('selected'=>true))));
    'ajax' => array(
    'type'=>'POST', 
    'url'=>Yii::app()->createUrl('/backend.php/order/InternalUpdateStatus'), //or $this->createUrl('loadcities') if '$this' extends CController
    //'update'=>'#city_name', //or 
	'success' => 'function(data){
		alert("Updated!")
	}',
  	'data'=>array('id'=>'js:this.value','order_id'=>$data->order_id),
  ))); ?>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>


	<?php /*


	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_cost_currency')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_cost_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />



		<b><?php echo CHtml::encode($data->getAttributeLabel('order_status')); ?>:</b>
	<?php echo CHtml::encode($data->order_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_status_internal')); ?>:</b>
	<?php echo CHtml::encode($data->order_status_internal); ?>
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

