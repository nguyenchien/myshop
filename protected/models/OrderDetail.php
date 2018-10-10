<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property integer $order_detail_id
 * @property integer $order_id
 * @property integer $pro_id
 * @property integer $price
 * @property string $date_create
 * @property integer $quality
 */
class OrderDetail extends OrderDetailBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDetailBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
