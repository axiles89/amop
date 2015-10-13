<?php
/**
 * ProjectController.php
 *
 * @package app\controllers
 * @date: 16.09.2015 19:25
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;

use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
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
    const CACHE_TIME_LIST_PROJECT = 1;

    /**
     * @return array
     */
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

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($id) {
        \Yii::$app->getView()->params['leftMenu']['active'] = "project_$id";

        $model = $this->findModel($id);

        $query = ListProfiler::find()->where(['project_id' => $id]);

        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::PAGE_SIZE
            ],
            'sort' => false
        ]);

        return $this->render('detail.tpl',[
            'model' => $model,
            'data' => $data,
            'total' => $query->count()
        ]);
    }

    /**
     * Редактирование проекта
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id) {

        \Yii::$app->getView()->params['leftMenu']['active'] = "project_$id";

        $model = $this->findModel($id);

        if (\Yii::$app->request->isPost and $model->load(\Yii::$app->request->post()) and \Yii::$app->user->id == $model->staff_id and $model->save()) {
            \Yii::$app->response->redirect('/project/index')->send();
        }

        return $this->render('edit.tpl', [
                'model' => $model,
        ]);
    }

    /**
     * Удаление проекта
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionDelete($id) {

        $model = $this->findModel($id)->delete();
        \Yii::$app->response->redirect('/project/index')->send();
    }

    /**
     * Список проектов пользователя
     * @return string
     */
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


    /**
     * Добавление проекта
     * @return string
     */
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

    /**
     * Получение модели проекта
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Проект не найден');
        }
    }

}