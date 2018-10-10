<?php
/**
 * Created by PhpStorm.
 * User: PC-06
 * Date: 12/06/2018
 * Time: 11:05 AM
 */

class Navigation extends CWidget {
    public function run(){
        $data = Category::getAllCate();
        $id = Yii::app()->request->getParam('id');
        $action = Yii::app()->controller->action->id;
        $cateId = "";
        if ($action) {
            if ($action == 'list') { // product list
                $cateId = $id;
            } elseif ($action == 'detail'){ // product detail
                $cate = Product::getCateByProductID($id); //$id: product id
                if ($cate) {
                    $cateId = $cate->cate_id;
                }
            }
        }
        $this->render('navigation', array(
            'data' => $data,
            'cateId' => $cateId
        ));
    }
}