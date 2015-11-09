<?php
/**
 * ProfilerController.php
 *
 * @package app\controllers
 * @date: 06.10.2015 19:51
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;


use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
use app\models\amop\models\Project;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\components\widget\durationGraph\DurationGraph;

/**
 * Class ProfilerController
 * @package app\controllers
 */
class ProfilerController extends BaseController
{
    const PAGE_SIZE = 3;

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
     * @author Dianov German <es_dianoff@yahoo.com>
     * Action call delete profiler
     * @param $id profiler id
     */
    
    public function actionDeleteProfiler($id) {
        $model = $this->findModelListProfiler($id)->delete();
        \Yii::$app->response->redirect(\Yii::$app->request->referrer);
    }



    public function actionDetail($id) {
        $profiler = $this->findProfiler($id);
        $project = Project::findOne($profiler->project_id);

        if (!$project) {
            throw new NotFoundHttpException('Проект профайлера не найден');
        }

        \Yii::$app->getView()->params['leftMenu']['active'] = "profiler_{$profiler->id}";

 
     
        $data = new ActiveDataProvider([
            'query' => DurationGraph::getQuery($id),
            'pagination' => [
                'pageSize' => self::PAGE_SIZE
            ],
            'sort' => false
        ]);

        return $this->render('detail.tpl',[
            'model' => $project,
            'profiler' => $profiler,
            'data'  => $data,
            'totalMessage' => Profiler::find()->where(['message_id' => $id])->count(),
            'total' => ListProfiler::find()->where(['project_id' => $project->id])->count()
        ]);
    }


     /**
     * @author Dianov German <es_dianoff@yahoo.com>
     * Find profile list by ID
     * @param $id profiler id
     */
    protected function findProfiler($id) {
        if (($model = ListProfiler::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Профайлер не найден');
        }
    }


     /**
     * @author Dianov German <es_dianoff@yahoo.com>
     * Find profiler by ID
     * @param $id profiler id
     */
    protected function findModelListProfiler($id)
    {
        if (($model = Profiler::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Profiler not found');
        }
    }

}