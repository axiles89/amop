<?php


return [
    'user1' => [
        'surname' => 'test',
        'login' => 'test',
        'name' => 'test',
        'avatar' => 'test',
        'auth_key' => 'test',
        'date_create' => '2015-01-01 12:12:12',
        'password' => Yii::$app->security->generatePasswordHash('dm1989'), //dm1989
        'email' => 'test@mail.ru'
    ]
];