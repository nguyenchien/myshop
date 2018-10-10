<?php
/**
 * Created by PhpStorm.
 * User: PC-06
 * Date: 12/06/2018
 * Time: 11:05 AM
 */

class Menu extends CWidget {
    public function run(){
        $userInfo = Yii::app()->user->getState('userInfo');
        $this->render('menu', array('data'=>$userInfo));
    }
}