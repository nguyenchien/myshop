<?php
    class ProductController extends Controller{

        public function actionIndex(){
            $this->render('index');
        }

        // Action List Product By Cate Id
        public function actionList($id){
            /*
            // Cách 1: render data bình thường
            // Get page param from url
            $param = Yii::app()->request->getParam('page');
            $page = isset($param) ? ($param - 1) : 0;

            // Count all product by cate id
            $count = Product::getNumberRecord($id);

            // Set items per page
            $pages = new CPagination($count);
            $apage = Yii::app()->params['pager'];
            $pages->setPageSize($apage);

            // Get product by cate id
            $data = Product::getProductByCateId($id, $page, $apage);

            // Render to view /list
            $this->render('list', array(
                'data'=>$data,
                'pages'=>$pages,
            ));
            */

            // Cách 2: render data sử dung CListView
            $dataProvider = new CActiveDataProvider('Product', array(
                'criteria'=>array(
                    'condition'=>'cate_id='.$id,
                ),
                'pagination'=>array(
                    'pageSize'=>6,
                ),
            ));
            $this->render('list', array('dataProvider'=>$dataProvider));
        }

        //Action product detail by product id
        public function actionDetail($id){
            $data = Product::getProductDetail($id);
            $productsSameCate = Product::getProductsSameCate($data->cate_id, array($id));
            $this->render('detail', array(
                'prodItem'=>$data,
                'productsSameCate' =>$productsSameCate,
                'cate_id'=>$data->cate_id
            ));
        }

    }