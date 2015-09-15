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

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
        parent::init();
        $this->getView()->params['leftMenu']['active'] = null;
    }


}