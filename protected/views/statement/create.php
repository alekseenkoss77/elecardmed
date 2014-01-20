<?php
/* @var $this StatementController */
/* @var $model Statement */

$this->breadcrumbs=array(
	'Показания'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'List Statement', 'url'=>array('index')),
	array('label'=>'Manage Statement', 'url'=>array('admin')),
);
?>

<h1>
    Внести показания
    <?php
        if($user->organization)
        {
            echo ' ('.$user->organization->name.')';
        }
    ?>
</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'buildings'=>$buildings)); ?>