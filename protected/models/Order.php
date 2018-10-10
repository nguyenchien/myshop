<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $order_id
 * @property integer $user_id
 * @property string $order_date
 * @property string $modified_date
 * @property integer $total
 * @property integer $status
 * @property string $user_ship
 * @property string $email_ship
 * @property string $address_ship
 * @property string $phone_ship
 */
class Order extends OrderBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	 * Get all orders
	 */
	public static function getAllOrders(){
	    $data = Order::model()->findAll();
	    return $data;
    }

	/*
	 * Get user info from order id
	 * return user obj
	*/
    public static function getUserByOrderID($id){
        $data = Order::model()->findByPK($id);
        return $data->user;
    }

    /*
     * Get order detail from order id
     * Return: order detail obj
    */
    public static function getOrderDetailByOrderID($id){
        $data = Order::model()->findByPK($id);
        return $data->order_detail;
    }

}
