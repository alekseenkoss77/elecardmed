<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(!Yii::app()->user->isGuest): ?>

<div class="user-info">
	<?php echo $user->role; ?><br/>
	<span class="org_bold">Ф.И.О: </span><?php echo $user->name; ?><br/>
	<span class="org_bold">E-mail: </span><?php echo $user->email; ?><br/>
	<span class="org_bold">Телефон: </span><?php echo $user->phone; ?><br/>
	<span class="org_bold">Лицевой счет: </span><?php echo $user->account; ?><br/><br/>
	
	<span class="org_bold">Дом (адрес): </span><?php if($user->building) {echo $user->building->address;} ?><br/>
	<span class="org_bold">Квартира (номер): </span><?php if($user->flat) {echo $user->flat->number;} ?><br/>
	<span class="org_bold">ТСЖ: </span> <?php if($user->organization) {echo $user->organization->name;} ?>
</div>

<?php else: ?>

<div class="user-guest">Вы вошли как гость, пожалуйста войдите с систему!</div>

<?php endif; ?>
