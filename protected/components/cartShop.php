<?php
    class cartShop{
         /*
          * Luu thong tin san pham vao session cart
          * $id: Ma san pham
          * $quality: So luong san pham
         */
         public static function addCart($id, $quality = 1){
             //Create session cart
             $cart = Yii::app()->session['cart'];
             $proInfo = Product::getProductDetail($id);

             //Check session cart
             if(empty($cart)){ //Mua hang lan dau
                 //Tao mang 2 chieu de luu thong tin dat hang
                 $cart[$id] = array(
                     "quality" => $quality,
                     "price" => $proInfo->price,
                     "name" => $proInfo->pro_name,
                     "image" => $proInfo->image
                 );
             }else{ //Gio hang co san pham roi
                 //Kiem tra san pham dang mua co trong gio hang hay khong?
                 if(array_key_exists($id, $cart)){ //Co trong gio hang => Cộng dồn thêm
                     $cart[$id] = array(
                         "quality" => (int)$cart[$id]["quality"] + (int)$quality,
                         "price" => $proInfo->price,
                         "name" => $proInfo->pro_name,
                         "image" => $proInfo->image
                     );
                 }else{ //Chua co trong gio hang
                     $cart[$id] = array(
                         "quality" => $quality,
                         "price" => $proInfo->price,
                         "name" => $proInfo->pro_name,
                         "image" => $proInfo->image
                     );
                 }
             }
             //Luu thong tin gio hang vao session
             Yii::app()->session['cart'] = $cart;
         }

        /*
         * Hien thi thong tin gio hang
        */
        public static function showInfoCart(){
            $data = Yii::app()->session['cart'];
            if(isset($data)){
                echo json_encode($data);
            }
        }

         /*
          * Hien thi so luong san pham trong gio hang
         */
         public static function showQualityCart(){
             $total = 0;
             $data = Yii::app()->session['cart'];
             if(isset($data)){
                 foreach ($data as $item){
                     $total += $item['quality'];
                 }
             }
             echo $total;
         }

         /*
          * Update so luong trong gio hang
         */
         public static function updateCart($id, $quality){
             $cart = Yii::app()->session['cart'];
             $proInfo = Product::getProductDetail($id);
             if($quality > 0){
                 if(array_key_exists($id, $cart)){
                     $cart[$id] = array(
                         "quality" => (int)$quality,
                         "price" => $proInfo->price,
                         "name" => $proInfo->pro_name,
                         "image" => $proInfo->image
                     );
                 }
             }
             //Update lai session cart
             Yii::app()->session['cart'] = $cart;
         }

        /*
         * Update so luong trong gio hang
         * Popup ở page /product/detail
        */
        public static function updateCartPopup($id, $quality){
            $cart = Yii::app()->session['cart'];
            $proInfo = Product::getProductDetail($id);
            if($quality > 0){
                if(array_key_exists($id, $cart)){
                    $cart[$id] = array(
                        "quality" => (int)$quality,
                        "price" => $proInfo->price,
                        "name" => $proInfo->pro_name,
                        "image" => $proInfo->image
                    );
                }
            }
            //Update lai session cart
            Yii::app()->session['cart'] = $cart;
            echo json_encode($cart);
        }

        /*
         * Delete so luong trong gio hang
        */
        public static function deleteCart($id){
            $cart = Yii::app()->session['cart'];
            if(array_key_exists($id, $cart)){
                unset($cart[$id]);
            }
            //Update lai session cart
            Yii::app()->session['cart'] = $cart;
        }

        /*
         * Xóa so luong trong gio hang
         * Popup ở page /product/detail
        */
        public static function deleteCartPopup($id){
            $cart = Yii::app()->session['cart'];
            if(array_key_exists($id, $cart)){
                unset($cart[$id]);
            }
            //Update lai session cart
            Yii::app()->session['cart'] = $cart;
            echo json_encode($cart);
        }

    }