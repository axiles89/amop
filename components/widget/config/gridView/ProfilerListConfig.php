<?php
/**
 * ProfilerListConfig.php
 *
 * @package app\components\widget\config\gridView
 * @date: 05.10.2015 23:11
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\config\gridView;

use yii\helpers\Html;

/**
 * Конфигурация вывода списка профайлеров проекта
 * Class ProfilerListConfig
 * @package app\components\widget\config\gridView
 */
class ProfilerListConfig
{
    /**
     * @param $data
     * @return array
     */
    public static function getData($data) {

        return [
            'dataProvider' => $data,
            'tableOptions' => [
                'class' => 'table table-bordered table-hover dataTable'
            ],
            'emptyCell'=>'-',
            'emptyText' => 'Нет результатов',
            'layout' => "{items}{summary}{pager}",
            'summary' => "<span>Показано {begin} - {end} ,  всего {totalCount}</span>",
            'pager' => [
                'options' => ['class' => 'pagination', 'style' => ['float' => 'right']]
            ],
            'columns' => [
                [
                    'attribute' => 'id',
                    'label' => 'ID',
                    'format' => 'html',
                    'headerOptions' => ['width' => '50'],
                    'value' => function($data) {
                        return Html::a(
                            $data->id,
                            '/profiler/detail/'.$data->id, ['title' => 'Детальный просмотр профайлера']);
                    }
                ],
                [
                    'attribute' => 'message',
                    'label' => 'Название',
                    'format' => 'html',
                    'value' => function($data) {
                        return Html::a(
                            $data->message,
                            '/profiler/detail/'.$data->id, ['title' => 'Детальный просмотр профайлера']);
                    }
                ],
                [
                    'attribute' => 'date_create',
                    'label' => 'Дата создания',
                    'format' => ['date', 'dd.MM.Y  HH:mm'],
                    'headerOptions' => ['width' => '200']
                ],
                [
                    'attribute' => 'date_update',
                    'label' => 'Дата обновления',
                    'format' => ['date', 'dd.MM.Y  HH:mm'],
                    'headerOptions' => ['width' => '200']
                ]
            ]
        ];
    }
}