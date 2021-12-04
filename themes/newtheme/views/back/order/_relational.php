<div class="row">
    <div class="col-md-7">
<div class="well">
    <h5>Order Details [<?php echo $data->order_number;?>]</h5>
<?php
//echo CHtml::tag('h3',array(),'RELATIONAL DATA EXAMPLE ROW : "'.$id.'"');
/*$this->widget('booster.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    'columns' => array_merge(array(array('class'=>'booster.widgets.TbImageColumn')),
    array(
        'member_id',
        'order_status',
        'order_status_internal'
    )),

));*/
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
'type'=>'striped bordered',
'dataProvider' => $dataProvider,
    //'filter'=>$order,
'template' => "{items}\n{extendedSummary}",
   'id'=>'test_'.$id,

   /*'pager'=>array(
                    'header'=>'',
                    'maxButtonCount'=>5,
                    'selectedPageCssClass'=>'active',
                    'hiddenPageCssClass'=>'disabled',
                    'firstPageCssClass'=>'previous',
                    'lastPageCssClass'=>'next',
                    ),*/
  'columns'=>array( 
    array(
        'class'=>'bootstrap.widgets.TbImageColumn',
                'imagePathExpression'=>'$data->product->Fullimagepath',
                'usePlaceKitten'=>FALSE,
                'imageOptions'=>array('width'=>'50px'),
    ),
    array(
        'name'=>'brand',
        'value'=>'$data->product->brand_name',
        ),
    array(
        'name'=>'product_id',
        'value'=>'$data->product->product_name',
        ),
    'quantity',
    'price',
    'currency',
    'Subtotal'
    ),
  /*'extendedSummary' => array(
        'title' => 'Total Employee Hours',
        'columns' => array(
            'Subtotal' => array('label'=>'price', 'class'=>'TbSumOperation')
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well pull-right',
        'style' => 'width:300px'
    ),*/
));
?>
</div>
    <div class="well">
        <h5>Shipment Details [<?php echo $data->order_number;?>]</h5>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Shipment Method</th>
            <th>Contact name</th>
            <th>Contact phone</th>
            <th>address</th>
            <th>Remarks</th>
        </tr>
        </thead>
        <tr>
            <td><?php echo ($data->shipment_method =="SELF PICKUP")? $data->shipment_method.'<br>門市:'.$data->self_pickup_location.'<br>提取編號:'.$data->verification_code:$data->shipment_method.'<br>運費:'.$data->shipment_cost;?></td>
            <td>
                <?php echo $data->title;?> <?php $data->name;?>
            </td>
            <td>
                <?php echo $data->phone;?>
            </td>
            <td>
                <?php echo nl2br($data->address);?><br>
                <?php if($data->country_code == "OO"){ ?>
            <?php echo $data->country;?><br>
                <?php }else{?>
                <?php echo $data->countryCode->country_name_chi;?><br>
                <?php echo $data->postal_code;?>
                <?php } ?>
            </td>
            <td>
                <?php echo $data->remarks;?><br>
            </td>
        </tr>
    </table>
        </div>
</div>

<div class="col-md-5">
     <div class="well">
        <h5>Action</h5>
        <?php /** @var TbActiveForm $form */
$form = $this->beginWidget(
'booster.widgets.TbActiveForm',
array(
'id' => 'horizontalForm',
'type' => 'horizontal',
)
); ?>
<?php echo $form->dropDownListGroup($model,'order_status',array(
        'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-7',
    ),
    'widgetOptions'=>array(
    /*'htmlOptions'=>array(
    'class'=>'col-sm-5',
    'maxlength'=>2,
    ),*/
    
    'data'=>array('1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'己送出','6'=>'請與客服聯絡','7'=>'其他'),
    ))); ?>

<?php echo $form->dropDownListGroup($model,'order_status_internal',array(
        'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-7',
    ),
    'widgetOptions'=>array(
    /*'htmlOptions'=>array(
    'class'=>'col-sm-5',
    'maxlength'=>2,
    ),*/
    
    'data'=>array('1'=>'待付款','2'=>'已付款','3'=>'付款未能成功','4'=>'處理中','5'=>'己送出','6'=>'與客人聯絡中','7'=>'取消','8'=>'其他'),
    ))); ?>
<?php echo $form->textAreaGroup(
            $model,
            'remarks_internal',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-md-7',
                ),
                'widgetOptions' => array(
                    'htmlOptions' => array('rows' => 5),
                )
            )
        ); ?>
<?php if($data->shipment_method == "BY COURIER") {?>
<hr>
<h5>BY COURIER action</h5>
<?php echo $form->textFieldGroup(
$model,
'courier_name',
array(
'wrapperHtmlOptions' => array(
'class' => 'col-sm-7',
),
//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
)
); ?>
<?php echo $form->textFieldGroup(
$model,
'courier_website',
array(
'wrapperHtmlOptions' => array(
'class' => 'col-sm-7',
),
//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
)
); ?>
<?php echo $form->textFieldGroup(
$model,
'courier_tracking_no',
array(
'wrapperHtmlOptions' => array(
'class' => 'col-sm-7',
),
//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
)
); ?>
<?php } ?>
<?php if($data->shipment_method == "BY COURIER") {?>
<?php echo $form->checkboxGroup($model,'sendShipmentEmail'); ?>
<?php } ?>
<div class="row">
    <div class="col-md-2">
    <div class="text-left">
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'context' => 'primary',
                'label' => 'Submit'
            )
        ); ?>
</div>
</div>
</div>
<?php $this->endWidget(); ?>
</div>
</div>

    
</div>

