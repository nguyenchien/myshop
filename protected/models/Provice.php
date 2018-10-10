<?php

/**
 * This is the model class for table "provice".
 *
 * The followings are the available columns in table 'provice':
 * @property integer $provice_id
 * @property string $provice_name
 */
class Provice extends ProviceBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'provice';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProviceBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
