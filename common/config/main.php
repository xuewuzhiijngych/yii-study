<?php

use common\components\Storage;
use common\components\WxappService;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'store' => [
            'class' => Storage::className(),
        ],

        'wxapp' => [
            'class' => WxappService::className(),
            'appid' => 'wx2631d7e022453fd4',
            'secret' => 'eda3b430183be78ccaaea222707ee75d',
            'grant_type' => 'authorization_code',
        ],

        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2b',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8mb4',
        ],
    ],
];
