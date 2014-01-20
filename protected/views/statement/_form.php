<?php
/* @var $this StatementController */
/* @var $model Statement */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'statement-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'counter_value'); ?>
		<?php echo $form->textField($model,'counter_value'); ?>
		<?php echo $form->error($model,'counter_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'counter_date'); ?>
		<?php echo $form->dateField($model,'counter_date'); ?>
		<?php echo $form->error($model,'counter_date'); ?>
	</div>

	<?php if(empty($model->counter_id) && empty($model->flat_id)): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'building_id'); ?>
			<?php echo $form->dropDownList($model,'building_id',
						       CHtml::listData($buildings,'id','address'),
						       array(
							'ajax' => array(
								'type' => 'POST',
								'url' => CController::createUrl('statement/dynamicFlat'),
								'update' => '#Statement_flat_id'
								)));
			?>
			<?php echo $form->error($model,'building_id'); ?>	
		</div>
	<?php endif; ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'flat_id'); ?>
		<?php
			if(empty($model->flat_id))
			{
				echo $form->dropDownList($model,'flat_id',array(),array(
									'ajax' => array(
										'type' => 'POST',
										'url' => CController::createUrl('statement/dynamicCounter'),
										'update' => '#Statement_counter_id'
									))); 
			} else {
				echo $model->flat->number;
			}
		?>
		<?php echo $form->error($model,'flat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'counter_id'); ?>
		<?php
			if(empty($model->counter_id))
			{
				echo $form->dropDownList($model,'counter_id',array());
			} else {
				echo $model->counter->type;
			}
			
		?>
		<?php echo $form->error($model,'counter_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->