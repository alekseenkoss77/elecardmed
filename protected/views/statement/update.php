<?php
/* @var $this StatementController */
/* @var $model Statement */

$this->breadcrumbs=array(
	'Statements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Statement', 'url'=>array('index')),
	array('label'=>'Create Statement', 'url'=>array('create')),
	array('label'=>'View Statement', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Statement', 'url'=>array('admin')),
);
?>

<h1>Изменить показание <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'buildings'=>$buildings)); ?>