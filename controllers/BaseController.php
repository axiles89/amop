<?php
/**
 * BaseController.php
 *
 * @package app\controllers
 * @date: 02.09.2015 20:28
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;


class BaseController extends Controller
{
    public $layout = "main.tpl";

}