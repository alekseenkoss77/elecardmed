<?php
/* @var $this StatementController */
/* @var $model Statement */

$this->breadcrumbs=array(
	'Statements'=>array('index'),
	'Create',
);

?>

<h1>Добавить показания воды</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'statement-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные<span class="required">*</span> обязательны.</p>

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

        <?php if($user->flat): ?>
            <div class="row">
                    <?php echo $form->labelEx($model,'counter_id'); ?>
                    <?php echo $form->dropDownList($model,'counter_id',
                                                    CHtml::listData(Counter::model()->findAll('flat_id=:flat_id', array(':flat_id'=>$user->flat_id)),'id','type')); ?>
                    <?php echo $form->error($model,'counter_id'); ?>
            </div>
        <?php else: ?>
            <span>Вы не прикреплены к квартире, вы не сможете указать показания</span>
        <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->