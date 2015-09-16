<?php
/**
 * ProjectController.php
 *
 * @package app\controllers
 * @date: 16.09.2015 19:25
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;


use app\models\amop\models\Project;
use yii\filters\AccessControl;

/**
 * Контроллер для работы с проектами
 * Class ProjectController
 * @package app\controllers
 */
class ProjectController extends BaseController
{

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


    public function actionAdd(){
        \Yii::$app->getView()->params['leftMenu']['active'] = 'project_add';

        $model = new Project();

        if (\Yii::$app->request->isPost and $model->load(\Yii::$app->request->post())) {

            $model->staff_id = \Yii::$app->user->id;
            if ($model->validate()) {
                $model->save();
                \Yii::$app->response->redirect('/project/list')->send();
            }
        }

        return $this->render('add.tpl',[
            'model' => $model
        ]);
    }

}