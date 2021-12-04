<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal'
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php /*echo $form->textFieldGroup($model,'email',
array(
'widgetOptions'=>array(
'htmlOptions'=>array(
'class'=>'span5',
'maxlength'=>255
)
)
)
); */?>
<?php echo $form->textFieldGroup(
			$model,
			'email',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
<?php echo $form->textFieldGroup(
			$model,
			'display_name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
<?php /*echo $form->textFieldGroup(
			$model,
			'password',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>10
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); */?>
<?php echo $form->textFieldGroup(
			$model,
			'contact_phone',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>20
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
<?php echo $form->textAreaGroup(
			$model,
			'bill_address',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
<?php echo $form->textFieldGroup(
			$model,
			'title',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>20
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
<?php echo $form->textFieldGroup(
			$model,
			'name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
	<?php echo $form->textFieldGroup(
			$model,
			'phone',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>20
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
			<?php echo $form->textAreaGroup(
			$model,
			'address',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
			<?php echo $form->textFieldGroup(
			$model,
			'postal_code',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>20
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>
<?php /*echo $form->textFieldGroup($model,'display_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); */?>
<?php /*echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); */?>

<?php /*echo $form->textFieldGroup($model,'contact_phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20))));*/ ?>
<?php /*echo $form->textFieldGroup($model,'bill_address',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); */?>


	<?php /*echo $form->textFieldGroup($model,'title',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); */?>

	<?php /*echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); */?>

	<?php /*echo $form->textFieldGroup($model,'phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); */?>

	<?php /*echo $form->textFieldGroup($model,'address',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); */?>

	<?php /*echo $form->textFieldGroup($model,'postal_code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20))));*/ ?>

	<?php echo $form->dropDownListGroup($model,'country_code',array(
		'wrapperHtmlOptions' => array(
					'class' => 'col-sm-2',
	),
	'widgetOptions'=>array(
	/*'htmlOptions'=>array(
	'class'=>'col-sm-5',
	'maxlength'=>2,
	),*/
	
	'data'=>Chtml::listData(CountryCode::model()->findAll(array("condition"=>"status='ACTIVE'", 'order'=>'ordering_chi')), 'country_code', 'country_name_chi')
	))); ?>

	<?php echo $form->textFieldGroup(
			$model,
			'country',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
				//'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
			)
		); ?>

	<?php /* echo $form->textFieldGroup($model,'country',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255))));*/ ?>
<?php echo $form->dropDownListGroup($model,'status', array(
	'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
					'maxlength'=>255
				),
'widgetOptions'=>array(
'data'=>array("ACTIVE"=>"ACTIVE","INACTIVE"=>"INACTIVE",), '
htmlOptions'=>array(
'class'=>'input-large'
)))); ?>


<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
