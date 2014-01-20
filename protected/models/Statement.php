<?php

/**
 * This is the model class for table "tbl_statement".
 *
 * The followings are the available columns in table 'tbl_statement':
 * @property integer $counter_value
 * @property string $counter_date
 * @property integer $flat_id
 * @property integer $counter_id
 *
 * The followings are the available model relations:
 * @property TblFlat $flat
 * @property TblCounter $counter
 */
class Statement extends CActiveRecord
{
	public $building_id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_statement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('counter_date', 'required'),
			array('counter_value, flat_id, counter_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('counter_value, counter_date, flat_id, counter_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'flat' => array(self::BELONGS_TO, 'Flat', 'flat_id'),
			'counter' => array(self::BELONGS_TO, 'Counter', 'counter_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'counter_value' => 'Значение показаний',
			'counter_date' => 'Дата внесения показаний',
			'flat_id' => 'Квартира',
			'counter_id' => 'Счетчик',
			'building_id' => 'Дом'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('counter_value',$this->counter_value);
		$criteria->compare('counter_date',$this->counter_date,true);
		$criteria->compare('flat_id',$this->flat_id);
		$criteria->compare('counter_id',$this->counter_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	// push info to log model if record update
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if(!$this->isNewRecord)
			{
				$log = new StatementLog;
				$log->counter_id = $this->counter_id;
				$log->value = $this->counter_value;
				$log->date_change = new CDbExpression('NOW()');
				$log->person = Yii::app()->user->id;
				$log->save();
			}
			return true;
		}
		return false;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Statement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
