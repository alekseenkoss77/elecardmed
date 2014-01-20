<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $account
 * @property string $phone
 * @property string $role
 *
 * The followings are the available model relations:
 * @property TblFlat[] $tblFlats
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	public static $roles = array(
		'occupant' => 'Жилец',
		'direction' => 'Правление'
	);
	
	public $password_repeat;
	
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, password_repeat, email', 'required'),
			array('name', 'length', 'max'=>255),
			array('username, password, email', 'length', 'max'=>128),
			array('account, phone, role', 'length', 'max'=>250),
			array('password', 'compare', 'compareAttribute'=>'password_repeat')
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
			'building' => array(self::BELONGS_TO,'Building','building_id'),
			'organization' => array(self::BELONGS_TO,'Organization','organization_id')			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Ф.И.О.',
			'username' => 'Логин',
			'password' => 'Пароль',
			'email' => 'Почта',
			'account' => 'Лицевой счет',
			'phone' => 'Телефон',
			'role' => 'Права',
			'building_id' => 'Дом',
			'flat_id' => 'Квартира'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
		
	// Before filter that hash the password from form
	protected function beforeSave()
	{
	     if(parent::beforeSave())
	     {
		if($this->isNewRecord)
		{
		    // Хешировать пароль
		    $hash_pass = crypt($this->password);
		    $this->password = $hash_pass;
		}
		return true;
	     }
	    return false;
	}
}
