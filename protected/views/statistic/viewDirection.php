<?php
/* @var $this StatisticController */

$this->breadcrumbs=array(
	'Statistic'=>array('/statistic'),
	'ViewDirection',
);
?>

<h1>Статистика по ТСЖ</h1>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'statistic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="filter-row">
		<label>Дом:</label>
		<?php echo CHtml::dropDownList('building_id','',
					       CHtml::listData(Building::model()->findAll(),'id','address'),
					       array('empty'=> 'Дом',
						'ajax'=>array(
							'type' => 'POST',
							'url' => CController::createUrl('statistic/dynamicPorch'),
							'update' => '#porch_id'	
						))); ?>
	</div>
	
	<div class="filter-row">
		<label>Подъезд:</label>
		<?php echo CHtml::dropDownList('porch_id','',array(),
					       array(''=> '--Подъезд--',
						'ajax'=>array(
							'type' => 'POST',
							'url' => CController::createUrl('statistic/dynamicFlat'),
							'update' => '#flat_id'	
						))); ?>
	</div>
	
	<div class="filter-row">
		<label>Квартира</label>
		<?php echo CHtml::dropDownList('flat_id','',array(''=>'--Квартира--')); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>
<?php if(isset($statistic) && count($statistic) > 0): ?>
	<table>
		<thead>
			<tr>
				<th>Дом</th>
				<th>Квартира</th>
				<th>Общие показания</th>
				<th>Счетчик</th>
			</tr>
		</thead>
		<tbody>
				<?php foreach($statistic as $v): ?>
					<tr>
						<td><?php echo $v['address']; ?></td>
						<td><?php echo $v['number']; ?></td>
						<td><?php echo $v['sum']; ?></td>
						<td><?php echo $v['type']; ?></td>
					</tr>
				<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

