<?php

class ShoppingcartController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	/*
	 * Them san pham vao gio hang
	*/
	public function actionAddCart(){
	    $productID = Yii::app()->request->getParam('product_id');

	    //Thêm sản phẩm vào giỏ hàng
	    cartShop::addCart($productID);

        //Hien thi thong tin gio hang
        cartShop::showInfoCart();
    }

    /*
     * Danh sach san pham trong gio hang
    */
    public function actionCart(){
        $data = Yii::app()->session['cart'];
	    $this->render('cart', array('data'=>$data));
    }

    /*
     * Update so luong san pham trong gio hang
    */
    public function actionUpdateCart(){
        $productID = Yii::app()->request->getParam('product_id');
        $sl = Yii::app()->request->getParam('sl');
        cartShop::updateCart($productID, $sl);
        cartShop::showQualityCart();
    }

    /*
     * Update so luong san pham trong gio hang
     * Popup ở page /product/detail
    */
    public function actionUpdateCartPopup(){
        $productID = Yii::app()->request->getParam('product_id');
        $sl = Yii::app()->request->getParam('sl');
        cartShop::updateCartPopup($productID, $sl);
    }

    /*
     * Delete so luong san pham trong gio hang
    */
    public function actionDeleteCart(){
        $productID = Yii::app()->request->getParam('product_id');
        cartShop::deleteCart($productID);
        cartShop::showQualityCart();
    }

    /*
     * Xóa so luong san pham trong gio hang
     * Popup ở page /product/detail
    */
    public function actionDeleteCartPopup(){
        $productID = Yii::app()->request->getParam('product_id');
        cartShop::deleteCartPopup($productID);
    }

    /*
     * Action confirm
    */
    public function actionConfirm(){
        $data = Yii::app()->session['cart'];
        $this->render('confirm', array('data'=>$data));
    }

    /*
     * Action payment
    */
    public function actionPayMent(){
        $data = Yii::app()->session['cart'];
        $this->render('payment', array('data'=>$data));
    }

    /*
     * Action finish
    */
    public function actionFinish(){
        $data = Yii::app()->session['cart'];
        if(count($data) > 0){
            $userInfo = Yii::app()->user->getState('userInfo');
            if(isset($_POST['finish'])){
                $total = 0;
                foreach ($data as $id => $productItem){
                    $total += (int)$productItem['quality'] * (int)$productItem['price'];
                }
                $modelOrder = new Order;
                if(!empty($userInfo["user_id"])){
                    $modelOrder->user_id = $userInfo["user_id"];
                }else{
                    $modelOrder->user_id = 0;
                }
                $modelOrder->order_date = date("Y-m-d H:i:s");
                $modelOrder->total = $total;
                $modelOrder->status = 0;
                $modelOrder->user_ship = $_POST['username'] != "" ? $_POST['username'] : $userInfo['user_name'];
                $modelOrder->email_ship = $_POST['email'] != "" ? $_POST['email'] : $userInfo['email'];
                $modelOrder->address_ship = $_POST['address'] != "" ? $_POST['address'] : $userInfo['address'];
                $modelOrder->phone_ship = $_POST['phone'] != "" ? $_POST['phone'] : $userInfo['phone'];
                if($modelOrder->save(false)){
                    //Save data vao bang order, save(false): không kiểm tra quan hệ giữa các bảng.
                    $orderID = $modelOrder->order_id;
                    foreach ($data as $id => $productItem){
                        $modelOrderDetail = new OrderDetail;
                        $modelOrderDetail->order_id = $orderID;
                        $modelOrderDetail->pro_id = $id;
                        $modelOrderDetail->price = $productItem["price"];
                        $modelOrderDetail->quality = $productItem["quality"];
                        $modelOrderDetail->date_create = date("Y-m-d H:i:s");
                        //Luu data vao bang Order Detail
                        $modelOrderDetail->save(false);
                    }
                }
                //Sau khi luu thong tin vao 2 bang Order va Order Detail xong => Send mail
                $this->SendMail();

                //Delete session cart
                unset(Yii::app()->session['cart']);
            }
            $this->render('thankyou');
        }else{
            $this->redirect(Yii::app()->homeUrl);
        }
    }


    //Send mail
    public function SendMail(){
        $data = Yii::app()->session['cart'];
        $userInfo = Yii::app()->user->getState('userInfo');
        $i= 0 ;
        $total = 0;
        $email_received = "";
        $body_mail = "Cảm ơn bạn đã đặt hàng tại <a href='".BASE_URL."'>EShop</a>. Chúng tôi sẽ liên lạc với bạn trong vòng 1h giờ tới. Dưới đây là thông tin mà bạn đã đặt hàng.";
        $body_mail .= "<h3>Thông tin đặt hàng của bạn:</h3>";
        $body_mail .= "<table style='border: 1px solid #000; border-collapse: collapse;'>";
        $body_mail .= "<tr style='border: 1px solid #000; border-collapse: collapse;'>";
        $body_mail .= "<th style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>No</th>";
        $body_mail .= "<th style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>Name</th>";
        $body_mail .= "<th style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>Quality</th>";
        $body_mail .= "<th style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>Price</th>";
        $body_mail .= "<th style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>Summary</th>";
        $body_mail .= "</tr>";
        foreach ($data as $id => $productItem){
            $i++;
            $total += (int)$productItem['quality'] * (int)$productItem['price'];
            $body_mail .= "<tr style='border: 1px solid #000; border-collapse: collapse;'>";
            $body_mail .= "<td style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>".$i."</td>";
            $body_mail .= "<td style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'><a href='".BASE_URL."/product/detail/".$id."'>".$productItem['name']."</a></td>";
            $body_mail .= "<td style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>".$productItem['quality']."</td>";
            $body_mail .= "<td style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>".number_format($productItem['price'])."</td>";
            $body_mail .= "<td style='border: 1px solid #000; border-collapse: collapse; padding: 3px;'>".number_format((int)$productItem['quality'] * (int)$productItem['price'])."  VNĐ</td>";
            $body_mail .= "</tr>";
        }
        $body_mail .= "</table>";
        $body_mail .= "<p style='font-weight: bold;'>Total: ".number_format($total)." VNĐ</p>";

        if(!empty($userInfo["user_id"])){
            $email_received = $userInfo['email'];
        }else{
            if(isset($_POST['finish'])){
                $email_received = $_POST['email'];
            }
        }
        if(!empty($email_received)){
            $message = new YiiMailMessage;
            $message->setSubject('Shopping Cart Information From EShop');
            $message->setBody($body_mail, 'text/html');
            $message->setTo($email_received);
            $message->setFrom('chiennguyen1702@gmail.com');
            Yii::app()->mail->send($message);
        }else{
            $this->redirect(array("shoppingcart/payment"));
        }
    }

}