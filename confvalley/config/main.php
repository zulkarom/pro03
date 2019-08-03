<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-confvalley',
	'name'=>'CONFERENCE MANAGER',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'confvalley\controllers',
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'controllerMap' => [
				'registration' => 'confvalley\controllers\user\RegistrationController',
				'security' => 'confvalley\controllers\user\SecurityController',
				'recovery' => 'confvalley\controllers\user\RecoveryController'
			],
			'modelMap' => [
				'RegistrationForm' => 'confvalley\models\user\RegistrationForm',
				'User' => 'confvalley\models\user\User',
				'LoginForm' => 'confvalley\models\user\LoginForm',
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
            'csrfParam' => '_csrf-confvalley',
        ],
		
		'view' => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@confvalley/views/user'
				],
			],
		],
        /* 'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-confvalley', 'httpOnly' => true],
        ], */
        'session' => [
            // this is the name of the session cookie used for login on the confvalley
            'name' => 'advanced-confvalley',
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
            'class' => 'confvalley\modules\supplier\Module',
        ],
		'catalog' => [
            'class' => 'confvalley\modules\catalog\Module',
        ],
		'client' => [
            'class' => 'confvalley\modules\client\Module',
        ],
    ], */
	
	
    'params' => $params,
];
