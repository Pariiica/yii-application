<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'enableCsrfCookie' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'l1KepQGYHp9azjsjN1rGAzDV_6nmkbYv',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
//             this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
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
                'user/<id:\w+>' => 'user/view',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => ['user'],
            'prefix' => 'v1',
            'tokens' => [
                '{did}' => '<id:[\\w\\W]+>'
            ],
            'extraPatterns' => [
                'PUT,PATCH {did}' => 'update',
                'DELETE {did}' => 'delete',
                'DELETE' => 'delete',
                'GET,HEAD {did}' => 'view',
                '{did}' => 'options',
            ],
        ],
    ],
    'params' => $params,
];
