<?php
/**
 * ProfilerListConfig.php
 *
 * @package app\components\widget\config\gridView
 * @date: 5.11.2015 21.00.00
 * @author: Dianov German <es_dianoff@yahoo.com.ru>
 */

namespace app\components\widget\config\gridView;

use yii\helpers\Html;
use Yii;
/**
 * Конфигурация вывода списка профайлеров
 * Class ProfilerListConfig
 * @package app\components\widget\config\gridView
 */

class ProfileListDataConfig
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
                ],
                [
                    'attribute' => 'date_create',
                    'label' => 'Дата создания',
                    'format' => ['date', 'dd.MM.Y  HH:mm'],
                    'headerOptions' => ['width' => '200']
                ],
                [
                    'attribute' => 'duration',
                    'label' => 'Продолжительность',
                    'format' => 'html',
                    'value' => 'duration',
                    'headerOptions' => ['width' => '200']
                ],
                [
                    'attribute' => 'time_start',
                    'label' => 'Старт',
                    'format' => 'html',
                    'headerOptions' => ['width' => '200'],
                    'value' => function($data) {
                        return Yii::$app->formatter->asDate($data->time_start/1000, 'yyyy-MM-dd H:m:s');
                    }
                ],
                [
                    'attribute' => 'time_end',
                    'label' => 'Завершение',
                    'format' => 'html',
                    'headerOptions' => ['width' => '200'],
                    'value' => function($data) {
                         return Yii::$app->formatter->asDate($data->time_end/1000, 'yyyy-MM-dd H:m:s');
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Удалить',
                    'contentOptions' => ['style' => ['text-align' => 'center']],
                    'headerOptions' => ['width' => '80'],
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                '/profiler/delete-profiler/'.$model->id, [
                                    'title' => 'Удалить',
                                    'data-confirm' => 'Действительно удалить запись?',
                                    'data-method' => 'post',
                                    'data-pjax' => '1',
                                ]);
                        }
                    ],
                ],
            ]
        ];
    }






}



