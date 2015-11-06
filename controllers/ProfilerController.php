<?php
/**
 * ProfilerController.php
 *
 * @package app\controllers
 * @date: 06.10.2015 19:51
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers;


use app\models\amop\commands\LastActiveDate;
use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
use app\models\amop\models\Project;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Class ProfilerController
 * @package app\controllers
 */
class ProfilerController extends BaseController
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

    public function actionDetail($id) {
        $profiler = $this->findProfiler($id);

        LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)
            ->setData((integer)$id)
            ->setUserId(\Yii::$app->user->id)
            ->save();

        $project = Project::findOne($profiler->project_id);

        if (!$project) {
            throw new NotFoundHttpException('Проект профайлера не найден');
        }

        \Yii::$app->getView()->params['leftMenu']['active'] = "profiler_{$profiler->id}";

        return $this->render('detail.tpl',[
            'model' => $project,
            'profiler' => $profiler,
            'totalMessage' => Profiler::find()->where(['message_id' => $id])->count(),
            'total' => ListProfiler::find()->where(['project_id' => $project->id])->count()
        ]);
    }

    protected function findProfiler($id) {
        if (($model = ListProfiler::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Профайлер не найден');
        }
    }

}