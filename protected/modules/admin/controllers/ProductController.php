<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/*return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/
        return array(
            array('allow', 'users' => array('@'), 'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete')),
            array('deny', 'users' => array('*')),
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        //Get Category from model
        $cate = Category::getAllCate();

        //Convert cate obj to array list data
        $data = CHtml::listData($cate, 'cate_id', 'cate_name');

        /*
         * Get path of directory 'uploads'
         * $path: .../data/uploads
        */
        $path = Yii::getPathOfAlias('webroot') . '/uploads';
        $temTime = time();

		if(isset($_POST['Product'])) {
			$model->attributes=$_POST['Product'];

            // Dùng class CUploadedFile để up hình lên server
            $image = CUploadedFile::getInstance($model, 'image');
            $image_2 = CUploadedFile::getInstance($model, 'image_2');
            $image_3 = CUploadedFile::getInstance($model, 'image_3');

            // Quy định định dạng hình cho phép
            $ext_allow = array('jpg', 'png', 'jpeg', 'gif');

            // Get định dạng hình
            $ext = substr($image->name, strrpos($image->name, '.') + 1);
            $ext_2 = substr($image_2->name, strrpos($image_2->name, '.') + 1);
            $ext_3 = substr($image_3->name, strrpos($image_3->name, '.') + 1);

            // Quy định kích thước hình cho phép
            $size_allow = 1024 * 1024 * 1; // 1 MB

            // Get kích thước hình
            $size = $image->size;
            $size_2 = $image_2->size;
            $size_3 = $image_3->size;

            if(!empty($image)){
                if(!in_array($ext, $ext_allow)){
                    echo '<script language="javascript">';
                    echo 'alert("Định dạng hình không cho phép!")';
                    echo '</script>';
                } elseif ($size > $size_allow || $size == 0){
                    echo '<script language="javascript">';
                    echo 'alert("Dung lượng hình phải <= 1M!")';
                    echo '</script>';
                } else {
                    // Lưu hình lên server với name = name gốc + $temTime
                    $image->saveAs($path . '/' . $temTime.$image->name);
                    $image_2->saveAs($path . '/' . $temTime.$image_2->name);
                    $image_3->saveAs($path . '/' . $temTime.$image_3->name);

                    // Lưu đường dẫn hình vào DB
                    $model->image = '/uploads/'.$temTime.$image->name;
                    $model->image_2 = '/uploads/'.$temTime.$image_2->name;
                    $model->image_3 = '/uploads/'.$temTime.$image_3->name;
                }
            }

            // Save data to model
            if($model->save())
                $this->redirect(array('view','id'=>$model->pro_id));
		}

		$this->render('create',array(
			'model'=>$model,
            'data'=>$data
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        //Get Category from model
        $cate = Category::getAllCate();

        //Convert cate obj to array list data (key=>value)
        $data = CHtml::listData($cate, 'cate_id', 'cate_name');

		if(isset($_POST['Product'])) {
			$model->attributes=$_POST['Product'];
            $temTime = time();
            $path = Yii::getPathOfAlias('webroot') . '/uploads';

            // Main mage
			if( !empty($_FILES['Product']['name']['image']) ){
                //Upload image to server
                $image = CUploadedFile::getInstance($model, 'image');
                $image->saveAs($path.'/'.$temTime.$image->name);

                //Save image to model
                $model->image = '/uploads/'.$temTime.$_FILES['Product']['name']['image'];
            }

            // Sub image 1
            if ( !empty($_FILES['Product']['name']['image_2']) ) {
                $image_2 = CUploadedFile::getInstance($model, 'image_2');
                $image_2->saveAs($path.'/'.$temTime.$image_2->name);

                $model->image_2 = '/uploads/'.$temTime.$_FILES['Product']['name']['image_2'];
            }

            // Sub image 2
            if ( !empty($_FILES['Product']['name']['image_3']) ) {
                $image_3 = CUploadedFile::getInstance($model, 'image_3');
                $image_3->saveAs($path.'/'.$temTime.$image_3->name);

                $model->image_3 = '/uploads/'.$temTime.$_FILES['Product']['name']['image_3'];
            }

            // Save all to DB
            if($model->save()){
                $this->redirect(array('view','id'=>$model->pro_id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
            'data'=>$data
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
