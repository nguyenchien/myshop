<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $cate_id
 * @property string $cate_name
 * @property integer $status
 * @property string $date_create
 * @property string $date_modified
 */
class Category extends CategoryBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	 * Get all info from table Category
	 */
	public static function getAllCate(){
	    $data = Category::model()->findAll();
	    return $data;
    }

    /*
     * Get info cate from cate ID
     */
    public static function getCateName($id){
        $data = Category::model()->findByPk($id);
        return $data;
    }
}
