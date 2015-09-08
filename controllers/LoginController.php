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
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\UploadedFile;

class LoginController extends Controller
{
    public $layout = "main-login.tpl";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'register'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'register'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogout() {

        \Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister() {
        $model = new User(['scenario' => User::SCENARIO_REGISTER]);

        if (\Yii::$app->request->isPost and $model->load(\Yii::$app->request->post())){
            $model->imageAvatar = UploadedFile::getInstance($model, 'imageAvatar');

            if ($model->validate()) {

                if ($model->imageAvatar) {

                    $model->imageAvatar->saveAs('image/avatar/' . $model->login . '.jpg');
                    $model->avatar = $model->login . '.jpg';

                    $imagine = Image::thumbnail("image/avatar/" . $model->login . ".jpg", 150, 150)
                        ->save("image/avatar/mini-".$model->login.".jpg");

                    $model->imageAvatar = '';
                }

                $model->save();
                \Yii::$app->user->login($model);

                \Yii::$app->response->redirect('/site/index')->send();
            }
        }

        return $this->render('register.tpl', array(
            'model' => $model
        ));
    }

    public function actionIndex() {

        $form = new LoginForm();

        if (\Yii::$app->request->isPost and $form->load(\Yii::$app->request->post())  and $form->login()) {
            return $this->goHome();
        }

        return $this->render('index.tpl', array(
            'model' => $form
        ));

    }

}