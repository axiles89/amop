<?php
/**
 * Counter.php
 *
 * @package app\controllers\Ajax
 * @date: 06.11.2015 21:28
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\controllers\ajax;


use app\controllers\AjaxController;
use app\models\amop\commands\CountData;
use app\models\amop\commands\LastActiveDate;
use app\models\amop\models\Project;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\amop\models\ListProfiler;

/**
 * Class CounterController
 * @package app\controllers\ajax
 */
class CounterController extends AjaxController
{
    const CACHE_PROJECT_TIME = 300;

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
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception('Access denied', 403);
                }
            ],
        ];
    }

    /**
     * @return array
     */
    public function actionCount() {

        $result = [
            'profiler' => [
                'total' => false,
                'item' => []
            ]
        ];

        // Берем список проектов пользователя
        if (\Yii::$app->cache->exists('project:user:'.\Yii::$app->user->id)) {
            $project = \Yii::$app->cache->get('project:user:'.\Yii::$app->user->id);
        } else {
            $project = Project::find()->where(['staff_id' => \Yii::$app->user->id])->all();
            \Yii::$app->cache->set('project:user:'.\Yii::$app->user->id, $project, self::CACHE_PROJECT_TIME);
        }

        $idProject = ArrayHelper::getColumn($project, 'id');

        // Получение списка профайлеров по проектам
        $command = new ListProfiler\command\GetProfilerList();
        $command->setClassModel('app\models\amop\models\ListProfiler');
        $profiler = $command->setData($idProject)->execute();

        $idProfiler = ArrayHelper::getColumn($profiler, 'id');

        // Получаем список новых элементов для профайлеров
        $countProfiler = CountData::getModel(CountData::TYPE_PROFILER)->setData(function() use ($idProfiler) {
            return LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setData($idProfiler)
                ->setUserId(\Yii::$app->user->id)->get();
        })->getCount();

        $result['profiler']['item'] = $countProfiler;
        ($countProfiler) ? $result['profiler']['total'] = 'new' : $result['profiler']['total'] = false;

        return ['status' => 200, 'result' => $result];
    }
}