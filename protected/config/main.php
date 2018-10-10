<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    // Set time zone
    'timeZone' => 'Asia/Ho_Chi_Minh',

	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'EShop Web Application',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.base.*',
		'application.components.*',
        'ext.yii-mail.YiiMailMessage',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'admin',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors

            // Môi trường Dev
			'errorAction'=>YII_DEBUG ? null : 'site/error',

            // Môi trường Product
            //'errorAction' => 'site/error'
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

        //Send mail
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType'=>'smtp',
            'transportOptions'=>array(
                'host'=>'smtp.gmail.com',
                'username'=>'chiennguyen1702@gmail.com',
                'password'=>'Ttbdbt108@',
                'port'=>'465',
                'encryption'=>'ssl'
            ),
        ),

        // Detect biến cho mobile
        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        // Số phần tử trên 1 page
        'pager'=>6
	),

);
