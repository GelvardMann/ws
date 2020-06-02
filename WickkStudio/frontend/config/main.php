<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'language' => 'en',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        //'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en-*', 'ru-*'],
            'ignoreLanguageUrlPatterns' =>
                [
                    // route pattern => url pattern
                    '#^cart/(add|clear|del)#' => '#^cart/(add|clear|del)#',

                ],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:shop>/<action:view>/<id:\d+>' => '<controller>/<action>',
                '<controller:site>/<action:\w+>' => 'site/<action>',
                'about' => 'site/about',
                'brand' => 'site/brand',
                'contact' => 'site/contact',
                '<controller:shop>/<name:\w+>' => '<controller>/category',
                '<controller:blog>/<action:view>/<id:\d+>' => '<controller>/<action>',
                '<controller:cart>/<action:del>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/page/<page:\d+>' => '<controller>/index',


            ],
        ],
    ],
    'params' => $params,
];
