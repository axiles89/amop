<?php
/**
 * Data.php
 *
 * @package app\components\widget\leftMenu\data
 * @date: 15.09.2015 21:05
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\leftMenu\data;


use yii\base\Object;

/**
 * Формирование массива данных для меню
 * Class Data
 * @package app\components\widget\leftMenu\data
 */
class Data extends Object
{
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

        self::$data['user']['data']['avatar'] = \Yii::$app->user->getIdentity()->avatar;
        self::$data['user']['data']['name'] = \Yii::$app->user->getIdentity()->name;
        self::$data['user']['data']['surname'] = \Yii::$app->user->getIdentity()->surname;

        return self::$data;
    }


}