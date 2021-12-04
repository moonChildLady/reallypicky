<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>



		<?php echo $form->textFieldGroup($model,'order_number',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

		

		<?php echo $form->dateRangeGroup(
			$model,
			'order_created_date',
			array(
				
			'widgetOptions' => array(
					/*'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'*/
				'options'=>array(
					'format'=>'YYYY-MM-DD',
				)
				), 
		   		'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				//'hint' => 'Click inside! An even a date range field!.',
				'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
			)
		); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
