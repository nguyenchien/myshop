<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $pro_id
 * @property string $pro_name
 * @property integer $cate_id
 * @property integer $price
 * @property string $image
 * @property string $image_2
 * @property string $image_3
 * @property string $description
 * @property string $meta_key
 * @property string $meta_description
 * @property integer $status
 * @property string $date_create
 * @property string $date_modified
 */
class Product extends ProductBase
{
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	 * List product for Home page.
	*/
	public static function getProductHomePage(){
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->limit = 6;
	    $data = Product::model()->findAll($criteria);
	    return $data;
    }

    /*
	 * Count all product by cate Id
     * $id: cate id
	*/
    public static function getNumberRecord($id){
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->condition = "cate_id = " . $id;
        $data = Product::model()->count($criteria);
        return $data;
    }

    /*
	 * List product by Cate Id
     * $id: cate id
     * $page: offset
     * $apage: limit
     * SELECT * FROM product where `cate_id` = 1 limit 0, 6;
	*/
    public static function getProductByCateId($id, $page = 0, $apage = 0){
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->condition = "cate_id = " . $id;
        $criteria->offset = ($page * $apage);
        $criteria->limit = $apage;
        $data = Product::model()->findAll($criteria);
        return $data;
    }

    /*
     * Get product detail
     * $id: product id
     * Return: obj product
     */
    public static function getProductDetail($id){
        $data = Product::model()->findByPK($id);
        return $data;
    }

    /*
     * Get products same cate
     * $id: cate id
     */
    public static function getProductsSameCate($id, $without_ids=array()){
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->condition = "cate_id = " . $id;
        if(!empty($without_ids)){
            $criteria->condition .= " AND pro_id NOT IN ( " . implode(',', $without_ids) .")";
        }
        $data = Product::model()->findAll($criteria);
        return $data;
    }

    /*
     * Get cate by product id
     * $id: product id
     * Return: obj cate
    */
    public static function getCateByProductID($id){
        $data = Product::model()->findByPK($id);
        return $data->category;
    }
}
