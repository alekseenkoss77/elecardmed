<?php
/* @var $this StatementController */
/* @var $model Statement */

$this->breadcrumbs=array(
	'Statements'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Statement', 'url'=>array('index')),
	array('label'=>'Create Statement', 'url'=>array('create')),
	array('label'=>'Update Statement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Statement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Statement', 'url'=>array('admin')),
);
?>

<h1>View Statement #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'counter_value',
		'counter_date',
		'flat_id',
		'counter_id',
	),
)); ?>
