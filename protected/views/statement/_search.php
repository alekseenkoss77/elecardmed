<?php
/* @var $this StatementController */
/* @var $model Statement */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'counter_value'); ?>
		<?php echo $form->textField($model,'counter_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'counter_date'); ?>
		<?php echo $form->textField($model,'counter_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flat_id'); ?>
		<?php echo $form->textField($model,'flat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'counter_id'); ?>
		<?php echo $form->textField($model,'counter_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->