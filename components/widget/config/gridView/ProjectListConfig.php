<?php
/**
 * ProjectList.php
 *
 * @package app\components\widget\config\gridView
 * @date: 17.09.2015 23:27
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\config\gridView;


use yii\grid\SerialColumn;
use yii\helpers\Html;

/**
 * Конфигурация gridview виджета вывода списка проектов
 * Class ProjectListConfig
 * @package app\components\widget\config\gridView
 */
class ProjectListConfig
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
            'layout' => "{items}{summary}{pager}",
            'summary' => "<span>Показано {begin} - {end} ,  всего {totalCount}</span>",
            'pager' => [
                'options' => ['class' => 'pagination', 'style' => ['float' => 'right']]
            ],
            'columns' => [
                ['class' => SerialColumn::className()],
                'title',
                [
                    'attribute' => 'date_create',
                    'label' => 'Дата создания',
                    'format' => ['date', 'dd.MM.Y  HH:mm'],
                    'headerOptions' => ['width' => '200']
                ],
                [
                    'label' => 'Автор',
                    'format' => 'text',
                    'value' => function($data) {
                        return $data->staff->surname.' '.$data->staff->name;
                    }
                ],
                'secret_key',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Действия',
                    'contentOptions' => ['style' => ['text-align' => 'center']],
                    'headerOptions' => ['width' => '80'],
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                '/project/edit/'.$model->id, ['title' => 'Редактировать']);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                '/project/delete/'.$model->id, [
                                    'title' => 'Удалить',
                                    'data-confirm' => 'Действительно удалить проект?',
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