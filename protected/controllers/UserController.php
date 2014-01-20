<?php

class UserController extends Controller
{
	public function actionCreate()
	{
		$buildings = Building::model()->findAll();
		$model = new User();
		if(isset($_POST['User'])) {
			//print_r($_POST['User']);
			$model->attributes = $_POST['User'];
			
			if($model->validate()) {
				// save user data
				$model->building_id = (int)$_POST['User']['building_id'];
				$model->flat_id = (int)$_POST['User']['flat_id'];
				$model->organization_id = (int)$_POST['User']['organization_id'];
				//var_dump($model);
				$model->save(false);
				$this->redirect($this->createUrl('/'));
			}
		}
		$this->render('create', array('model' => $model, 'buildings' => $buildings));
	}
	
	public function actionDynamicflat() {
		$data = Flat::model()->findAll('building_id=:building_id',
					       array(':building_id'=>(int)$_POST['User']['building_id']));
		$data = CHtml::listData($data,'id','number');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value' => $value), CHTML::encode($name),true);
		}
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionUpdate()
	{
		$this->render('update');
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