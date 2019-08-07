<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-confmanager',
	'name'=>'CONFERENCE MANAGER',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'confmanager\controllers',
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'controllerMap' => [
				'registration' => 'confmanager\controllers\user\RegistrationController',
				'security' => 'confmanager\controllers\user\SecurityController',
				'recovery' => 'confmanager\controllers\user\RecoveryController'
			],
			'modelMap' => [
				'RegistrationForm' => 'confmanager\models\user\RegistrationForm',
				'User' => 'confmanager\models\user\User',
				'LoginForm' => 'confmanager\models\user\LoginForm',
			],
			// uncomment if in production
			//'enableConfirmation' => true, 
			//'enableUnconfirmedLogin' => false,
			
			'enableConfirmation' => true,
			'enableUnconfirmedLogin' => true,
			'enableFlashMessages' => false,
			
		],
		
	],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-confmanager',
        ],
		 'urlManager' => [
            'enablePrettyUrl' => true,
             'showScriptName' => false,
            'rules' => [
			'<controller>/<action>' => '<controller>/<action>', 
			
			
            ],
        ],
		
		'view' => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@confmanager/views/user'
				],
			],
		],
        /* 'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-confmanager', 'httpOnly' => true],
        ], */
        'session' => [
            // this is the name of the session cookie used for login on the confmanager
            'name' => 'advanced-confmanager',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
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
	
	/* 'modules' => [
        'supplier' => [
            'class' => 'confmanager\modules\supplier\Module',
        ],
		'catalog' => [
            'class' => 'confmanager\modules\catalog\Module',
        ],
		'client' => [
            'class' => 'confmanager\modules\client\Module',
        ],
    ], */
	
	
    'params' => $params,
];
