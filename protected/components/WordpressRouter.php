<?php
class WordpressRouter
{
	public function __construct()
	{
		//define('YII_ENABLE_EXCEPTION_HANDLER',false);
		//set_exception_handler(array($this,'handleException'));
	}

	public function handleException($exception)
	{
		// disable error capturing to avoid recursive errors
		restore_error_handler();
		restore_exception_handler();

		$event=new CExceptionEvent($this,$exception);
		if($exception instanceof CHttpException && $exception->statusCode == 404)
		{
			try
			{
				Yii::app()->runController("wp/index");
			}
			catch(Exception $e) {
                Yii::log('WordpressRouter Exception:'.$e->getMessage(), CLogger::LEVEL_WARNING);
            }
			// if we throw an exception in Wordpress on a 404, we can use our main error handler to handle the error
		}

		if(!$event->handled)
		{
			Yii::app()->handleException($exception);
		}
	}

	public function sweHandleException($exception) {
		if($exception instanceof CHttpException && $exception->statusCode == 404)
		{
			try
			{
				Yii::app()->runController("wp/index");
			}
			catch(Exception $e) {
				Yii::log('WordpressRouter Exception:'.$e->getMessage(), CLogger::LEVEL_WARNING);
			}
			// if we throw an exception in Wordpress on a 404, we can use our main error handler to handle the error
		}
	}
}
?>