<?php
use \kartik\datecontrol\Module;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'RegCard',
    'language'=>'th_TH',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'homeUrl'=>'?r=kpi/kpi/index',    
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
			'bundles' => [
				'dosamigos\google\maps\MapAsset' => [
				'options' => [
					'key' => 'AIzaSyBSsKUzYG_Wz7u2qL6unHqfBOmvaZ0H1Mg',// ใส่ API Regcard
					'language' => 'th',
					'version' => '3.1.18'
					]
				]
			]
		], 
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UB6B0iFnOzmOIFIZ2yXZat-cPVtDfII8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'formatter' => [ // ตั้งค่ารูปแแบการแสเงวันที่
            'dateFormat' => 'dd/MM/yyyy',
              'datetimeFormat' => 'dd/MM/yyyy H:i:s',
              'datetimeFormat' => 'php:d/m/Y H:i:s',
              'nullDisplay' => '',
           ],
           'thaiFormatter'=>[
            'class'=>'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules'=>[
        // DateControl Setting.... ตั้งค่าการแปลงวันที่
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
              Module::FORMAT_DATE => 'dd/MM/yyyy',
              Module::FORMAT_TIME => 'hh:mm:ss a',
              Module::FORMAT_DATETIME => 'php:d/m/Y H:i:s',
            ],
            'saveSettings' => [
              Module::FORMAT_DATE => 'yyyy-MM-dd', // saves as unix timestamp
              Module::FORMAT_TIME => 'php:H:i:s',
              Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            'displayTimezone' => 'Asia/Bangkok',
            'autoWidget' => true,
            'ajaxConversion'=>true,
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
              Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true,'todayHighlight' => true]], // example
              Module::FORMAT_DATETIME => ['type'=>2, 'pluginOptions'=>['autoclose'=>true,'todayHighlight' => true]], // setup if needed
              Module::FORMAT_TIME => [], // setup if needed
            ],
            'widgetSettings' => [
              Module::FORMAT_DATE => [
                'class' => 'yii\jui\DatePicker', // example
                'options' => [
                  'dateFormat' => 'php:d-M-Y',
                  'options' => ['class'=>'form-control'],
                ]
              ]
            ]
        ],
        // Datecontrol Setting End....
        'gridview' =>  [
          'class' => '\kartik\grid\Module'
             ],
        'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['admin']
            ],
      'rbac' => 'dektrium\rbac\RbacWebModule',
      'admin' => [
        'class' => 'mdm\admin\Module',
        'layout'=>'left-menu'
        ],      
         'license' => [
            'class' => 'app\modules\license\License',
        ],
          
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
            'site/*',
//            'user/admin/*',
//            'users/*',
//            'admin/*',
//            'rbac/*',
            'risk/*',
            'gii/*',
            'grid/*'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
