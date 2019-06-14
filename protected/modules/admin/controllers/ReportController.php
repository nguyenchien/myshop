<?php

class ReportController extends Controller
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
            array('allow', 'users' => array('@'), 'actions' => array('orderReceptionPdf')),
            array('deny', 'users' => array('*')),
        );
	}

    public function actionOrderReceptionPdf(){

        $order_id = Yii::app()->request->getParam('id');
        $order = Order::model()->findByPk($order_id);
        $viewPath  = Yii::getPathOfAlias('application.commands.views.order_reception_pdf.order_reception_body').'.php';
        $this->renderFile($viewPath,  array('order' => $order));
        die();

	    // Get Order Info
	    $order_id = Yii::app()->request->getParam('id');

        // Set up report path
        $reportPdfPath = implode(DIRECTORY_SEPARATOR, array(Yii::app()->basePath, 'runtime', 'report_pdf'));

        if (!file_exists($pdfPath = $reportPdfPath.DIRECTORY_SEPARATOR.'pdf')) {
            mkdir($pdfPath, 0777,true);
        }

        if ($order_id) {
            $updateTime = date('d-m-Y-H-i');
            $file_name = 'report_order_'.$order_id.'.pdf';
            $file_tmp = $pdfPath.DIRECTORY_SEPARATOR.$order_id.'_'.$updateTime.'.pdf';

            // Check $file_tmp file is not exist then call console create new $file_tmp file
            if (!file_exists($file_tmp)) {
                ConsoleRunner::console(array('waiting_command' => true))->run("report createBookingReception --order_id=$order_id  --file_tmp=$file_tmp > $reportPdfPath".DIRECTORY_SEPARATOR.'single_pdf_file.log');
            }

            if(Utils::readFilePdf($file_tmp, $file_name, false)) {
                Yii::app()->end();
            } else {
                ob_start();
                echo readfile($reportPdfPath.DIRECTORY_SEPARATOR.'single_pdf_file.log');
                $errors = ob_get_clean();
                Yii::app()->user->setFlash('error', $errors);
            }

        }

    }

}
