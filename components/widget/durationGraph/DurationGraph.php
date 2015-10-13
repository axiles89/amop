<?php
/**
 * DurationGraph.php
 *
 * @package app\components\widget\durationGraph
 * @date: 06.10.2015 22:53
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\widget\durationGraph;


use app\models\amop\models\Profiler;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * График выполнения скрипта по дню
 * Class DurationGraph
 * @package app\components\widget\durationGraph
 */
class DurationGraph extends Widget
{
    /**
     * @var
     */
    public $messageId;

    /**
     * @var string
     */
    public $title = '';

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
        parent::init();

        if (!isset($this->messageId)) {
            throw new InvalidConfigException("Not found messageId");
        }
    }

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        $filter = new Filter();

        $filter->load(\Yii::$app->request->get());
        $filter->validate();

        $data = Profiler::find()->andWhere(['message_id' => $this->messageId])
            ->andWhere(['>=', 'date_create', $filter->date_create_from])
            ->andWhere(['<', 'date_create', $filter->date_create_to.' 23:59'])
            ->asArray()->all();

        $y = [];

        foreach ($data as &$value) {
            $value['date_create'] = (\Yii::$app->formatter->asTimestamp($value['date_create'])) * 1000;
            $y[] = [(int)($value['date_create']), (int)($value['duration'])];
        }

        return $this->render("index.tpl", [
            'y' => $y,
            'title' => $this->title,
            'filter' => $filter
        ]);
    }


}