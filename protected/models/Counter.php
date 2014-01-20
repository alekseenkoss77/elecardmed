<?php

/**
 * This is the model class for table "tbl_counter".
 *
 * The followings are the available columns in table 'tbl_counter':
 * @property integer $id
 * @property string $type
 * @property string $serial_number
 * @property string $date_check
 * @property string $date_sealing
 * @property integer $building_id
 * @property integer $flat_id
 *
 * The followings are the available model relations:
 * @property TblStatement[] $tblStatements
 * @property TblBuilding $building
 * @property TblFlat $flat
 */
class Counter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_counter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, type, date_check, date_sealing', 'required'),
			array('id, building_id, flat_id', 'numerical', 'integerOnly'=>true),
			array('type, serial_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, serial_number, date_check, date_sealing, building_id, flat_id', 'safe', 'on'=>'search'),
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
			'tblStatements' => array(self::HAS_MANY, 'TblStatement', 'counter_id'),
			'building' => array(self::BELONGS_TO, 'TblBuilding', 'building_id'),
			'flat' => array(self::BELONGS_TO, 'TblFlat', 'flat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'serial_number' => 'Serial Number',
			'date_check' => 'Date Check',
			'date_sealing' => 'Date Sealing',
			'building_id' => 'Building',
			'flat_id' => 'Flat',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('serial_number',$this->serial_number,true);
		$criteria->compare('date_check',$this->date_check,true);
		$criteria->compare('date_sealing',$this->date_sealing,true);
		$criteria->compare('building_id',$this->building_id);
		$criteria->compare('flat_id',$this->flat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Counter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
