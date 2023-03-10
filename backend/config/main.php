<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'name' => "Helpy Dashboard",
    'modules' => [
        'private-api' => [
            'class' => 'backend\modules\privateApi\api',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'permissions' => [
            'class' => 'backend\modules\permissions\Module',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !Yii::$app->user->isGuest && Yii::$app->user->can('managePermission');
                        }
                    ]
                ]
            ],
        ],
        'i18n' => [
            'class' => 'common\lib\i18nModule\Module',
            'defaultRoute' => 'translation/index',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],

        'user' => [
            'class' => 'common\components\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'dashboard'                                       => 'site/index',
                'profile'                                         => 'user/view',
                'login'                                           => 'site/login',
                'categories'                                      => 'category/index',
                'requests/<request_id:\d+>/answers'               => 'request-answer/index',
                'GET requests/<request_id:\d+>/answers/create'    => 'request-answer/create',
                'GET requests/<request_id:\d+>/answers/update'    => 'request-answer/update',
                'GET requests/<request_id:\d+>/answers/view'      => 'request-answer/view',
                'POST requests/<request_id:\d+>/answers/delete' => 'request-answer/delete',
                'POST requests/<request_id:\d+>/answers/create'   => 'request-answer/create',
                'POST requests/<request_id:\d+>/answers/update'   => 'request-answer/update',
                '<controller:[\w-]+>s'                            => '<controller>',
                '<controller:[\w-]+>/<id:\d+>'                    => '<controller>/view',
                '<controller:[\w-]+>/<id:\d+>'                    => '<controller>/delete',
                '<controller:[\w-]+>/<id:\d+>'                    => '<controller>/update',

            ],
        ],
    ],
    'params' => $params,
];
