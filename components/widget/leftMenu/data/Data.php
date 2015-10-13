<?php
/**
 * Data.php
 *
 * @package app\components\widget\leftMenu\data
 * @date: 15.09.2015 21:05
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\leftMenu\data;


use app\models\amop\models\ListProfiler;
use app\models\amop\models\Project;
use yii\base\Object;
use yii\helpers\ArrayHelper;

/**
 * Формирование массива данных для меню
 * Class Data
 * @package app\components\widget\leftMenu\data
 */
class Data extends Object
{
    const CACHE_PROJECT_TIME = 300;

    protected static $data = [
        'user' => [
            'data' => [
                'avatar' => '',
                'name' => '',
                'surname' => ''
            ]
        ],
        'menu' => [
            'header' => 'Основное меню',
            'active' => '',
            'item' => [
                [
                    'label' => 'Проекты',
                    'name' => 'project',
                    'icon_class' => 'fa fa-inbox',
                    'url' => "#",
                    'item' => [
                        [
                            'label' => 'Добавить проект',
                            'name' => 'project_add',
                            'icon_class' => 'fa fa-plus',
                            'url' => '/project/add'
                        ]
                    ]
                ],
                [
                    'label' => 'Профайлеры',
                    'name' => 'profiler',
                    'icon_class' => 'fa fa-inbox',
                    'url' => "#",
                    'item' => [
                    ]
                ]
            ]
        ]
    ];


    /**
     * Получение меню
     * @return array
     */
    public function getData($active) {

        if ($active != null) {
            self::$data['menu']['active'] = $active;
        }

        if (\Yii::$app->cache->exists('project:user:'.\Yii::$app->user->id)) {
            $project = \Yii::$app->cache->get('project:user:'.\Yii::$app->user->id);
        } else {
            $project = Project::find()->where(['staff_id' => \Yii::$app->user->id])->all();
            \Yii::$app->cache->set('project:user:'.\Yii::$app->user->id, $project, self::CACHE_PROJECT_TIME);
        }

        $idProject = ArrayHelper::getColumn($project, 'id');
        $profiler = ListProfiler::find()->where(['project_id' => $idProject])
            ->orderBy([
                'message' => SORT_ASC,
            ])
            ->all();


        // Формирование списка профайлеров для меню
        foreach ($profiler as $valueProfiler) {
            self::$data['menu']['item'][1]['item'][] = [
                'label' => $valueProfiler->message,
                'name' => "profiler_".$valueProfiler->id,
                'icon_class' => 'fa fa-cube',
                'url' => '/profiler/detail/'.$valueProfiler->id];
        }

        // Формирование списка проектов для меню
        foreach ($project as $value) {
            self::$data['menu']['item'][0]['item'][] = [
                'label' => $value->title,
                'name' => "project_".$value->id,
                'icon_class' => 'fa fa-cube',
                'url' => '/project/detail/'.$value->id];
        }

        self::$data['user']['data']['avatar'] = \Yii::$app->user->getIdentity()->avatar;
        self::$data['user']['data']['name'] = \Yii::$app->user->getIdentity()->name;
        self::$data['user']['data']['surname'] = \Yii::$app->user->getIdentity()->surname;

        return self::$data;
    }


}