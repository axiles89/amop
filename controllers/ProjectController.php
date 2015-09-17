<?php
/**
 * ProjectController.php
 *
 * @package app\controllers
 * @date: 16.09.2015 19:25
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\amop\models\Project;
use yii\filters\AccessControl;

/**
 * Контроллер для работы с проектами
 * Class ProjectController
 * @package app\controllers
 */
class ProjectController extends BaseController
{

    const PAGE_SIZE = 100;
    const CACHE_TIME_LIST_PROJECT = 600;

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

    public function actionIndex()
    {
        $cache = false;

        $query = Project::find()->where(['staff_id' => Yii::$app->user->id])
            ->with('staff');

        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::PAGE_SIZE
            ],
            'sort' => false
        ]);

        if (Yii::$app->request->get('page') == '' or Yii::$app->request->get('page') == 1) {
            $cache = true;
        }

        return $this->render('index.tpl',[
            'data' => $data,
            'cache' => $cache,
            'cacheTime' => self::CACHE_TIME_LIST_PROJECT
        ]);
    }


    public function actionAdd(){
        \Yii::$app->getView()->params['leftMenu']['active'] = 'project_add';

        $model = new Project();

        if (\Yii::$app->request->isPost and $model->load(\Yii::$app->request->post())) {

            $model->staff_id = \Yii::$app->user->id;
            if ($model->validate()) {
                $model->save();
                \Yii::$app->response->redirect('/project/index')->send();
            }
        }

        return $this->render('add.tpl',[
            'model' => $model
        ]);
    }

}