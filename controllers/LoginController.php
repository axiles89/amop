<?php
/**
 * LoginController.php
 *
 * @package app\controllers
 * @date: 03.09.2015 20:16
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;


use app\models\amop\models\User;
use app\models\form\login\LoginForm;
use app\models\form\login\RegisterForm;
use yii\filters\AccessControl;
use yii\web\Controller;

class LoginController extends Controller
{
    public $layout = "main-login.tpl";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['index', 'register'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionRegister() {
        $form = new User(['scenario' => User::SCENARIO_REGISTER]);

        if (\Yii::$app->request->isPost and $form->load(\Yii::$app->request->post()) and $form->validate()){
            die("dd");
        }

        return $this->render('register.tpl', array(
            'model' => $form
        ));
    }

    public function actionIndex() {

        $form = new LoginForm();

        return $this->render('index.tpl', array(
            'model' => $form
        ));

    }

}