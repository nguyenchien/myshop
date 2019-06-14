<?php
/**
 * Created by PhpStorm.
 * User: PC-06
 * Date: 05/06/2019
 * Time: 8:48 AM
 */
class ReportCommand Extends CConsoleCommand {

    /**
     *
     * @param type $file
     * @param type $content
     * @return type
     */
    protected function writeFileHtml($file, $content) {
        $fh = fopen($file, "w");
        fwrite($fh, $content);

        return fclose($fh);
    }

    /**
     * @param $order
     * @param $file_tmp
     * @param bool|false $original_file_name
     * @return bool|null|string
     */
    public function getFilePDFTmp($order, $file_tmp, $original_file_name = false) {
        $pdfPath = implode(DIRECTORY_SEPARATOR, array(Yii::app()->basePath, 'command_tmp', MasterValues::RUNTIME_REPORT));
        $viewPath = implode(DIRECTORY_SEPARATOR, array(Yii::app()->basePath, 'commands', 'views'));

        //create header html
        $header_html_tmp = $pdfPath.DIRECTORY_SEPARATOR.md5(time().uniqid(rand(), true)).'_header.html';
        $header = $viewPath.DIRECTORY_SEPARATOR.'order_reception_pdf/order_reception_header.php';
        $html_header = $this->renderFile($header, array('order' => $order), true);

        // create content html
        $content_html_tmp = $pdfPath.DIRECTORY_SEPARATOR.md5(time().uniqid(rand(), true)).'_content.html';
        $content = $viewPath.DIRECTORY_SEPARATOR.'order_reception_pdf/order_reception_body.php';
        $content_html = $this->renderFile($content, array('order' => $order), true);

        // create footer html
        $html_footer_num_tmp = $pdfPath.DIRECTORY_SEPARATOR.'footer_num.html';
        $footer_num = $viewPath.DIRECTORY_SEPARATOR.'order_reception_pdf/order_reception_footer_num.php';
        $html_footer_num = $this->renderFile($footer_num, array(), true);
        if (!file_exists($html_footer_num_tmp)) {
            $this->writeFileHtml($html_footer_num_tmp, $html_footer_num);
        }

        $pdf_tmp = $this->writeFileHtml($content_html_tmp, $content_html) && $this->writeFileHtml($header_html_tmp, $html_header);

        if(is_file($header_html_tmp) && is_file($content_html_tmp)) {
            $pdf_tmp = Utils::createFilePDF(
                $file_tmp,
                $content_html_tmp,
                array('url' => $header_html_tmp, 'delete' => true),
                array('url' => $html_footer_num_tmp),
                true,
                '',
                $original_file_name ? true: false
            );
        }

        return $pdf_tmp;
    }

    /**
     * @param $order_id
     * @param $file_tmp
     * @return bool
     */
    public function actionCreateBookingReception($order_id, $file_tmp) {

        $is_get_one = false;
        if (!empty($order_id)) {
            $is_get_one = true;
            $order = Order::model()->findByPk($order_id);
        } elseif(!empty($shop_id) && !empty($from_hour)) {
//            $books = Book::model()->findAll(array(
//                'select' => '*',
//                'condition' => 'booking_status <> :booking_status
//				 AND status = :status
//				 AND shop_id = :shop_id
//				 AND date_format(from_hour, \'%Y-%m-%d\') = date_format(:from_hour, \'%Y-%m-%d\')',
//                'order' => 'from_hour ASC',
//                'params' => array (
//                    ':booking_status' => MasterValues::MV_BOOK_STATUS_CANCEL,
//                    ':status' => MasterValues::BOOK_STATUS_ENABLE,
//                    ':shop_id' => $shop_id,
//                    ':from_hour' => $from_hour
//                )
//            ));
        }

        if ($is_get_one) {
            if (!isset($order)) return false;
            return $this->getFilePDFTmp($order, $file_tmp, true);
        } else {
//            $array_pdf_tmp = array();
//            if (!isset($books)) return false;
//
//            $pdfPath = implode(DIRECTORY_SEPARATOR, array(Yii::app()->basePath, 'command_tmp', MasterValues::RUNTIME_REPORT, 'pdf'));
//
//            if (!file_exists($pdfPath)) {
//                mkdir($pdfPath, 0777,true);
//            }
//
//            foreach ($books as $book) {
//                $updateTime = DateTimeUtils::dateTimeFromDB($book->update_time,'YmdHis');
//                $file = $pdfPath.DIRECTORY_SEPARATOR.$book->book_id.'_'.$updateTime.'.pdf';
//                $array_pdf_tmp[] = is_file($file) ? $file: $this->getFilePDFTmp($book, $file, true);
//            }
//
//            return Utils::joinPdf($array_pdf_tmp, $file_tmp, true, true);
        }
    }
}