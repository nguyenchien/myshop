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

    /**
     * @param $path_name
     * @param $new_name_file
     * @return bool
     */
    public static function readFilePdf($path_name, $new_name_file, $removeOriginFile = true) {
        if(!file_exists($path_name)) {
            return false;
        }
        // Read file pdf from runtime folder
        header('Content-type: application/pdf;charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $new_name_file . '"'); // inline
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        header('Accept-Ranges: bytes');
        header('Content-Length: ' . filesize($path_name));

        ob_clean();
        $result = readfile($path_name);
        flush();

        // Delete file pdf from runtime folder
        return $removeOriginFile == true ? unlink($path_name): $result;
    }

    /**
     * Join multiple file pdf to a new file pdf
     * url get package: http://packages.ubuntu.com/trusty/pdftk
     * @param array $list_file_pdf
     * @param string $file_name
     * @param bool|false $get_path_file
     * @param bool|false $original_file_name
     * @return bool|string
     */
    public static function joinPdf($list_file_pdf = array(), $file_name = '', $get_path_file = false, $original_file_name =false) {
        if (!$list_file_pdf  || !$file_name) {
            return false;
        }

        $reportPdfPath = implode(DIRECTORY_SEPARATOR, array(Yii::app()->basePath, 'runtime', MasterValues::RUNTIME_REPORT));

        if (!file_exists($reportPdfPath)) {
            mkdir($reportPdfPath);
        }

        if ($original_file_name) {
            $path_file_store = $file_name;
        } else {
            $path_file_store = $reportPdfPath.DIRECTORY_SEPARATOR.'tmp_'.uniqid().'.pdf';
        }

        $list_pdf = implode('  ', $list_file_pdf);
        $path_file_debug = $reportPdfPath.DIRECTORY_SEPARATOR.'debug_pdf.txt';
        $stringExec = 'pdftk '.$list_pdf.' cat output '.$path_file_store .' 2> '.$path_file_debug;

        return exec($stringExec) !== false ? ($get_path_file ? $path_file_store: true): false;
    }

    /**
     * Create file pdf use tool wkhtmltopdf
     * url: //http://wkhtmltopdf.org/
     * @param string $fileName
     * @param string $linkGetData
     * @param array $header
     * @param array $footer
     * @param bool|false $get_path_file
     * @param string $top
     * @param bool|false $original_file_name
     * @return bool|string
     */
    public static function createFilePDF($fileName = '',  $linkGetData = '', $header = array(), $footer =  array(), $get_path_file = false, $top = '', $original_file_name = false) {
        $pathWkHtmlToPdf = Yii::app()->params['pathWkHtmlToPdf'];
        $reportPdfPath = implode(DIRECTORY_SEPARATOR, array(Yii::app()->basePath, 'runtime', MasterValues::RUNTIME_REPORT));

        if (!file_exists($reportPdfPath)) {
            mkdir($reportPdfPath);
        }

        if ($original_file_name) {
            $pathFileStore = $fileName;
        } else {
            $pathFileStore = $reportPdfPath.'/'.'tmp_'.uniqid().'.pdf';
        }

        $pathFileDebug = $reportPdfPath.'/debug_pdf.txt';

        // Save file pdf to runtime folder
        if ($header && $footer) {
            if (!empty($header['url']) && !empty($footer['url'])){
                $stringExec = sprintf('"%s" --header-html "%s" --footer-html "%s" --print-media-type -n %s -B 10 "%s"  %s 2> %s', $pathWkHtmlToPdf,  $header['url'], $footer['url'], $top, $linkGetData, $pathFileStore, $pathFileDebug);
            }
        } else if ($header && !empty($header['url'])) {
            $stringExec = sprintf('"%s" --header-html "%s" --print-media-type -n %s "%s"  %s 2> %s', $pathWkHtmlToPdf, $header['url'] , $top, $linkGetData, $pathFileStore, $pathFileDebug);
        } else if ($footer && !empty($footer['url'])) {
            $stringExec = sprintf('"%s" --footer-html "%s" --print-media-type -n "%s"  %s 2> %s', $pathWkHtmlToPdf, $footer['url'],  $linkGetData, $pathFileStore, $pathFileDebug);
        } else {
            $stringExec = sprintf('"%s" --print-media-type -n "%s"  %s 2> %s', $pathWkHtmlToPdf, $linkGetData, $pathFileStore, $pathFileDebug);
        }

        exec($stringExec);

        // check exist and remove file *.header.html *_content.html
        if($get_path_file) {
            if (isset($header['url']) && file_exists($header['url'])) {
                unlink($header['url']);
            }

            if (isset($linkGetData) && file_exists($linkGetData)) {
                unlink($linkGetData);
            }

            return $pathFileStore;
        }

        $ext = strtolower(substr($fileName, strrpos($fileName, '.') + 1));

        if (file_exists($pathFileStore) && ($ext == 'pdf')) {
            return self::readFilePdf($pathFileStore, $fileName);
        }

        return false;
    }

}