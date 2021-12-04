<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('member-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$model->search()->sort->defaultOrder='order_created_date DESC';
//$model->search()->sort->defaultOrder='order_created_date ASC';
$this->widget('booster.widgets.TbExtendedGridView', array(
    'id'=>'member-grid',
    'filter'=>$model,
    'type'=>'striped bordered',
    'dataProvider' => $model->search(),
    'ajaxUpdate'=>false,
    'template' => "{items}{pager}",
    'columns' => array_merge(array(
        array(
            'class'=>'booster.widgets.TbRelationalColumn',
            'name' => 'order_number',
            'url' => $this->createUrl('order/relational'),
            'value'=> $model->order_id,
            'afterAjaxUpdate' => 'js:function(tr,rowid,data){
			//bootbox.alert("I have afterAjax events too!This will only happen once for row with id: "+rowid);
            }'
        )
    ),array(
		array(
            'name'=>'order_created_date',
            //'value'=> '$model->order_created_date',

            ),
		'name',
        'phone',
		array(
            'name'=>'order_status',
            'value'=>'$data->orderStatus',
			'filter'=>CHtml::dropDownList('Order[order_status]', 'order_status',  // you have to declare the selected value
                array('' =>'All', '1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'己送出','6'=>'請與客服聯絡','7'=>'其他'), array('prompt'=>'Select')
            ),
            ),
		'total_order_price_currency',
		'total_order_price',
		'shipment_method'
	)),
));?>
