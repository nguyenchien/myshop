<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $order_id
 * @property integer $user_id
 * @property string $order_date
 * @property integer $total
 * @property integer $status
 * @property string $user_ship
 * @property string $email_ship
 * @property string $address_ship
 * @property string $phone_ship
 */
class OrderBase extends CActiveRecord
{
    public $from_date = '';
    public $to_date = '';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, order_date', 'required'),
			array('order_id, user_id, total, status', 'numerical', 'integerOnly'=>true),
			array('user_ship, email_ship, address_ship, phone_ship', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_id, user_id, order_date, modified_date, total, status, user_ship, email_ship, address_ship, phone_ship', 'safe', 'on'=>'search'),

            // Set default value before save
            array('modified_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
            array('order_date, modified_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'create'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'order_detail' => array(self::HAS_MANY, 'OrderDetail', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order ID',
			'user_id' => 'Order User',
			'order_date' => 'Order Date',
			'modified_date' => 'Modified Date',
			'total' => 'Total Order',
			'status' => 'Status',
			'user_ship' => 'User Ship',
			'email_ship' => 'Email Ship',
			'address_ship' => 'Address Ship',
			'phone_ship' => 'Phone Ship',
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

        // Check form
        if (isset($_REQUEST['Order']) && $formData = $_REQUEST['Order']) {
            $this->from_date = !empty($formData['from_date']) ? $formData['from_date']: '';
            $this->to_date = !empty($formData['to_date']) ? $formData['to_date']: '';
        }

		$criteria=new CDbCriteria;
        $criteria->compare('order_id',$this->order_id);
		$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('status',$this->status);
		$criteria->compare('user_ship',$this->user_ship,true);
		$criteria->compare('email_ship',$this->email_ship,true);
		$criteria->compare('address_ship',$this->address_ship,true);
		$criteria->compare('phone_ship',$this->phone_ship,true);

		// Thêm điều kiện so sánh.
		$params  = array();
		if ($this->from_date) {
            $criteria->addCondition('date(order_date) >= :from_date');
            $params[':from_date'] = date('Y-m-d', strtotime($this->from_date));
        }
        if ($this->to_date) {
            $criteria->addCondition('date(order_date) <= :to_date');
            $params[':to_date'] = date('Y-m-d', strtotime($this->to_date));
        }

        // Cộng dồn điều kiện so sánh.
        $criteria->params += $params;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            //Custom số phần tử hiển thị trên trang
            'pagination' => array(
                'pageSize' => 10,
            ),
		));
	}

	/*
	 * Thống kê doanh thu theo sản phẩm.
	*/
    public function search2() {
        if (isset($_REQUEST['Order']) && $formData = $_REQUEST['Order']) {
            $this->from_date = !empty($formData['from_date']) ? $formData['from_date']: '';
            $this->to_date = !empty($formData['to_date']) ? $formData['to_date']: '';
        }
        $query = array();
        $query[] = 'SELECT od.pro_id, od.price, SUM(od.quality) AS quality, (SUM(od.quality)*od.price) AS summary FROM `order` AS o LEFT JOIN `order_detail` AS od ON od.order_id = o.order_id';
        $query[] = 'WHERE date( o.order_date) >= \''.date('Y-m-d', strtotime($this->from_date)).'\'';
        $query[] = 'AND date(o.order_date) <= \''.date('Y-m-d', strtotime($this->to_date)).'\'';
        $query[] = 'GROUP BY od.pro_id';
        $query = implode(' ', $query);
        //var_dump($query);die;
        $data = Yii::app()->db->createCommand($query)->queryAll();
        return $data;
    }


    /*
    * Thống kê doanh thu theo category.
    */
    public function search3() {
        if (isset($_REQUEST['Order']) && $formData = $_REQUEST['Order']) {
            $this->from_date = !empty($formData['from_date']) ? $formData['from_date']: '';
            $this->to_date = !empty($formData['to_date']) ? $formData['to_date']: '';
        }
        $query = array();
        $query[] = 'SELECT `p`.cate_id, sum(`od`.price*`od`.quality) as summary';
        $query[] = 'FROM `order_detail` AS `od` LEFT JOIN `order` AS `o` ON `od`.order_id = `o`.order_id';
        $query[] = 'LEFT JOIN `product` AS `p` ON `od`.pro_id = `p`.pro_id';
        $query[] = 'WHERE date(o.order_date) >= \''.date('Y-m-d', strtotime($this->from_date)).'\'';
        $query[] = 'AND date(o.order_date) <= \''.date('Y-m-d', strtotime($this->to_date)).'\'';
        $query[] = 'GROUP BY `p`.cate_id';
        $query = implode(' ', $query);
        $data = Yii::app()->db->createCommand($query)->queryAll();
        return $data;
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
}
