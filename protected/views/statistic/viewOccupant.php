<?php
/* @var $this StatisticController */

$this->breadcrumbs=array(
	'Statistic'=>array('/statistic'),
	'ViewOccupant',
);
?>
<h1>Статистика жильца</h1>

<?php if(isset($statistic) && count($statistic) > 0): ?>
	<span class="org_bold">Дом: </span><?php echo $statistic[0]['address']; ?><br/>
	<span class="org_bold">Квартира: </span><?php echo $statistic[0]['number']; ?><br/><br/>
	<table>
		<thead>
			<tr>
				<th>Общие показания</th>
				<th>Счетчик</th>
			</tr>
		</thead>
		<tbody>
				<?php foreach($statistic as $k=>$v): ?>
					<tr>
						<td><?php echo $v['sum']; ?></td>
						<td><?php echo $v['type']; ?></td>
					</tr>
				<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

