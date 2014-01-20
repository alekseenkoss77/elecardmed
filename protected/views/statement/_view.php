<?php
/* @var $this StatementController */
/* @var $data Statement */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('counter_value')); ?>:</b>
	<?php echo CHtml::encode($data->counter_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('counter_date')); ?>:</b>
	<?php echo CHtml::encode($data->counter_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flat_id')); ?>:</b>
	<?php echo CHtml::encode($data->flat_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('counter_id')); ?>:</b>
	<?php echo CHtml::encode($data->counter_id); ?>
	<br />


</div>