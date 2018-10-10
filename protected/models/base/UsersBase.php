<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property string $birthday
 * @property string $phone
 * @property integer $gender
 * @property string $address
 * @property integer $province_id
 * @property integer $status
 * @property string $date_create
 */
class UsersBase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, email, password, phone, birthday', 'required'),
			array('gender, province_id, status', 'numerical', 'integerOnly'=>true),
			array('user_name, email, password, phone, address', 'length', 'max'=>255),
			array('birthday, date_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, user_name, email, password, birthday, phone, gender, address, province_id, status, date_create', 'safe', 'on'=>'search'),

            // Set default value before save
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'create'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User ID',
			'user_name' => 'User Name',
			'email' => 'Email',
			'password' => 'Password',
			'birthday' => 'Birthday',
			'phone' => 'Phone',
			'gender' => 'Gender',
			'address' => 'Address',
			'province_id' => 'Province',
			'status' => 'Status',
			'date_create' => 'Date Create',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
