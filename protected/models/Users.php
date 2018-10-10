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
class Users extends UsersBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
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

	// Get User Info from User ID
    public static function getUserInfo($id){
        $data = Users::model()->findByPk($id);
        return $data;
    }

}
