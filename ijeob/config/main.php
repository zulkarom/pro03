<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-ijeob',
	'name'=>'IJEOB',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'ijeob\controllers',
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'controllerMap' => [
				'registration' => 'ijeob\controllers\user\RegistrationController',
				'security' => 'ijeob\controllers\user\SecurityController',
				'recovery' => 'ijeob\controllers\user\RecoveryController'
			],
			'modelMap' => [
				'RegistrationForm' => 'ijeob\models\user\RegistrationForm',
				'User' => 'ijeob\models\user\User',
				'LoginForm' => 'ijeob\models\user\LoginForm',
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
            'csrfParam' => '_csrf-ijeob',
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
					'@dektrium/user/views' => '@ijeob/views/user'
				],
			],
		],
        /* 'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-ijeob', 'httpOnly' => true],
        ], */
        'session' => [
            // this is the name of the session cookie used for login on the ijeob
            'name' => 'advanced-ijeob',
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
            'class' => 'ijeob\modules\supplier\Module',
        ],
		'catalog' => [
            'class' => 'ijeob\modules\catalog\Module',
        ],
		'client' => [
            'class' => 'ijeob\modules\client\Module',
        ],
    ], */
	
	
    'params' => $params,
];
