<?php
class Utils {

    // Cắt chữ để hiển thị đoạn văn ngắn
    public static function the_excerpt($text, $length = 300) {
        $newText = htmlentities($text, ENT_COMPAT, 'UTF-8');
        if(strlen($newText) > $length) {
            $newString = substr($newText, 0, $length); // return string
            $result = substr($newText, 0, strrpos($newString, ' '));
            return $result . " ...";
        } else {
            return $newText;
        }
    }

}