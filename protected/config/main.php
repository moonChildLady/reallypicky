<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/yiibooster');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	//'theme'=>'newtheme',
	// preloading 'log' component
	'preload'=>array(
		//'log',
		//'bootstrap'
		),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.easyPaypal.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'admin',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1127124',
			'generatorPaths'=>array(
       			'bootstrap.gii', // boostrap generator
    		),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('*'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('member/login'),
			//'loginUrl'=>array('/order/checkout/10001001'),
		),
		'bootstrap'=>array(
       		'class'=>'ext.yiibooster.components.Booster',
       		'responsiveCss'=>true,
    	),
		// uncomment the following to enable URLs in path-format
		'errorHandler'=>array(
            'errorAction' => 'site/error'
        ),
		'urlManager'=>array(
			//'baseUrl' => 'https://domain.com'
			'urlFormat'=>'path',
			'showScriptName'=>false,
			/*'rules'=>array(
				
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),*/
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=cctv.dress4u.hk;dbname=REALLYPICKY',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '23602312',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
				),*/
				
			),
		),
		'facebook'=>array(
        'class' => 'ext.yii-facebook-opengraph.SFacebook',
        //'appId'=>'201425073221915', // needed for JS SDK, Social Plugins and PHP SDK
        //'secret'=>'74b45aff576a6df877404cd89a70d052', // needed for the PHP SDK
        'appId'=>'201425073221915', // needed for JS SDK, Social Plugins and PHP SDK
        'secret'=>'74b45aff576a6df877404cd89a70d052', // needed for the PHP SDK
        //'fileUpload'=>false, // needed to support API POST requests which send files
        //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
        'locale'=>'zh_HK', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // don't include JS SDK
        //'async'=>true, // load JS SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'status'=>true, // JS SDK - check login status
        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
        //'oauth'=>true,  // JS SDK - enable OAuth 2.0
        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
        //'ogTags'=>array(  // set default OG tags
            //'og:title'=>'MY_WEBSITE_NAME',
            //'og:description'=>'MY_WEBSITE_DESCRIPTION',
            //'og:image'=>'URL_TO_WEBSITE_LOGO',
        //),
      ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'PAYPAL_API_USERNAME'=>'bill_api1.softpub.com',
        'PAYPAL_API_PASSWORD'=>'5QR3YAA4HG4J953G',
        'PAYPAL_API_SIGNATURE'=>'AupxCzk2GMo8RuHbOvVJarD2yBkAAlOXPAHh0J1JOCCopNFKMP4vLna.',
        /*'PAYPAL_API_USERNAME'=>'bill-facilitator_api1.softpub.com',
        'PAYPAL_API_PASSWORD'=>'1404185829',
        'PAYPAL_API_SIGNATURE'=>'A73EX78L9etKAeAoQQyPFR4ofnaaAK8maPiwxsonzG8OIUn6Guv.PgMF',*/
		'PAYPAL_MODE'=>'live',   // sandbox/live  default=sandbox,
		'test'=>'test'
	),
	'behaviors'=>array(
    'runEnd'=>array(
        'class'=>'application.components.WebApplicationEndBehavior',
    ),
),
);