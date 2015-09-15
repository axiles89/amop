<?php
/**
 * Error.php
 *
 * @package app\controllers
 * @date: 15.09.2015 22:57
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Контроллер ошибок
 * Class ErrorsController
 * @package app\controllers
 */
class ErrorsController extends BaseController
{
    public $layout = "main.tpl";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\web\ErrorAction',
                'view' => 'index.tpl'
            ]
        ];
    }

}