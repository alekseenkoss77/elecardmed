<?php

class StatisticController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(			
			array('allow',
			      'actions'=>array('viewOccupant'),
			      'users' => array('@'),
			      'expression' => 'Yii::app()->user->role=="occupant"'
			      ),
			array('allow',
			      'actions'=>array('dynamicFlat','dynamicPorch','viewDirection'),
			      'users' => array('@'),
			      'expression' => 'Yii::app()->user->role=="direction"'
			      ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionViewDirection()
	{
		/*
		* Да, так делать не очень хорошо, а вернее совсем не хорошо
		* Нужно было скорее всего делать через CDbCriteria где нибудь в
		* модельном методе search(); Однако не получилось толком разобраться с CDbCriteria
		* настолько, что бы сделать нормальный запрос с кучей джойнов. Вываливался постоянно
		* exception, побороть который уже не хватило времени. Поэтому тут присутствует такой код
		* который является примитивным фильтром квартир, подъездов, домов.
		*/
		
		$statistic = Yii::app()->db->createCommand()
			->select('b.address,f.number,SUM(counter_value),type')
			->from('tbl_statement s')
			->join('tbl_counter c','s.counter_id=c.id')
			->join('tbl_flat f','c.flat_id=f.id')
			->join('tbl_building b','f.building_id=b.id')
			->group('type,f.number,b.address,c.flat_id,f.building_id');
		
		if(!empty($_POST['building_id'])) {
			$statistic->having('f.building_id=:building_id',
					   array(':building_id'=>(int)$_POST['building_id']));
			
			if(!empty($_POST['flat_id'])) {
				$statistic->having('f.building_id=:building_id AND c.flat_id=:flat_id',
					   array(':building_id'=>(int)$_POST['building_id'], ':flat_id'=>(int)$_POST['flat_id']));
				
			}
		}
		
				
		$this->render('viewDirection',array('statistic'=>$statistic->queryAll()));
	}

	
	public function actionDynamicPorch() {
		$data = Porch::model()->findAll('building_id=:building_id',
					       array(':building_id'=>(int)$_POST['building_id']));
		$data = CHtml::listData($data,'id','number');
		echo CHtml::tag('option',array('value'=>''),'--Подъезд--',true);
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value' => $value), CHTML::encode($name),true);
		}
	}
	
	public function actionDynamicFlat() {
		$data = Flat::model()->findAll('building_id=:building_id',
					       array(':building_id'=>(int)$_POST['building_id']));
		$data = CHtml::listData($data,'id','number');
		echo CHtml::tag('option',array('value'=>''),'--Квартира--',true);
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value' => $value), CHTML::encode($name),true);
		}
	}
	
	public function actionViewOccupant()
	{
		$flat_id = User::model()->findByPk(Yii::app()->user->id)->flat_id;
		
		$statistic = Yii::app()->db->createCommand()
			->select('b.address,f.number,SUM(counter_value),type')
			->from('tbl_statement s')
			->join('tbl_counter c','s.counter_id=c.id')
			->join('tbl_flat f','c.flat_id=f.id')
			->join('tbl_building b','f.building_id=b.id')
			->group('type,f.number,b.address,c.flat_id')
			->having('c.flat_id=:flat_id',array(':flat_id'=>$flat_id))
			->queryAll();
			
		$this->render('viewOccupant', array('statistic'=>$statistic));
	}
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}