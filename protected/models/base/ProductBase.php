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
class ProductBase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pro_name, cate_id, price, image', 'required'),
			array('cate_id, price, status', 'numerical', 'integerOnly'=>true),
			array('pro_name, image, image_2, image_3', 'length', 'max'=>255),
			array('description, meta_key, meta_description, date_create, date_modified, image', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pro_id, pro_name, cate_id, price, image, image_2, image_3, description, meta_key, meta_description, status, date_create, date_modified', 'safe', 'on'=>'search'),

            // Set default value before save
            array('date_modified','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
            array('date_create, date_modified','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'create'),
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
            'category' => array(self::BELONGS_TO, 'Category', 'cate_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pro_id' => 'Product ID',
			'pro_name' => 'Product Name',
			'cate_id' => 'Category',
			'price' => 'Price',
			'image' => 'Image',
			'image_2' => 'Image 2',
			'image_3' => 'Image 3',
			'description' => 'Description',
			'meta_key' => 'Meta Key',
			'meta_description' => 'Meta Description',
			'status' => 'Status',
			'date_create' => 'Date Create',
			'date_modified' => 'Date Modified',
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

		$criteria->compare('pro_id',$this->pro_id);
		$criteria->compare('pro_name',$this->pro_name,true);
		$criteria->compare('cate_id',$this->cate_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('image_2',$this->image_2,true);
		$criteria->compare('image_3',$this->image_3,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_key',$this->meta_key,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_modified',$this->date_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
}
