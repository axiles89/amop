<?php
/**
 * Filter.php
 *
 * @package app\components\widget\durationGraph
 * @date: 06.10.2015 23:32
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\durationGraph;


use yii\base\Model;

/**
 * Class Filter
 * @package app\components\widget\durationGraph
 */
class Filter extends Model
{
    public $date_create_from;
    public $date_create_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create_from', 'date_create_to'], 'safe'],
            [['date_create_from', 'date_create_to'], 'date', 'format' => 'yyyy-MM-dd'],
            [['date_create_from', 'date_create_to'], 'default', 'value' => function ($model, $attribute) {
                return \Yii::$app->formatter->asDate("now", 'yyyy-MM-dd');
            }]
        ];
    }
}