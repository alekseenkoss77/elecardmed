<?php

class StatementController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
				'expression' => 'Yii::app()->user->role=="direction"'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('allow',
			      'actions'=>array('occupantCreate'),
			      'expression' => 'Yii::app()->user->role=="occupant"'
			      ),
			array('allow',
			      'actions'=>array('dynamicFlat','dynamicCounter'),
			      'expression' => 'Yii::app()->user->role=="direction"'
			      ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	public function actionOccupantCreate()
	{
		$model = new Statement();
		$user = User::model()->findByPk(Yii::app()->user->id);
			
		if(isset($_POST['Statement']))
		{
			$model->attributes=$_POST['Statement'];
			$model->flat_id = $user->flat_id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('createOccupant',array(
			'model'=>$model, 'user'=>$user
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Statement;
		$user = User::model()->findByPk(Yii::app()->user->id);
		$buildings = Building::model()->findAll('organization_id=:organization_id', array(':organization_id'=> $user->organization_id));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statement']))
		{
			$model->attributes=$_POST['Statement'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model, 'user'=>$user, 'buildings'=>$buildings
		));
	}

	public function actionDynamicFlat() {
		$data = Flat::model()->findAll('building_id=:building_id',
					       array(':building_id'=>(int)$_POST['Statement']['building_id']));
		$data = CHtml::listData($data,'id','number');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value' => $value), CHTML::encode($name),true);
		}
	}
	
	public function actionDynamicCounter() {
		$data = Counter::model()->findAll('flat_id=:flat_id',
					       array(':flat_id'=>(int)$_POST['Statement']['flat_id']));
		$data = CHtml::listData($data,'id','type');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value' => $value), CHTML::encode($name),true);
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$user = User::model()->findByPk(Yii::app()->user->id);
		$buildings = Building::model()->findAll('organization_id=:organization_id', array(':organization_id'=> $user->organization_id));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statement']))
		{
			$model->attributes=$_POST['Statement'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,'buildings'=>$buildings,'user'=>$user
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Statement');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Statement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Statement']))
			$model->attributes=$_GET['Statement'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Statement the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Statement::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Statement $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='statement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
