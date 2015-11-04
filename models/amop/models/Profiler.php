<?php

namespace app\models\amop\models;

use Yii;

/**
 * This is the model class for table "profiler".
 *
 * @property integer $id
 * @property string $date_create
 * @property string $date_update
 * @property integer $project_id
 * @property integer $type
 * @property string $message
 * @property integer $duration
 * @property integer $time_start
 * @property integer $time_end
 */
class Profiler extends \yii\db\ActiveRecord
{
    const TYPE_LIGHT_MESSAGE = 1;

    protected $_typeList = [
        self::TYPE_LIGHT_MESSAGE => 'Light type message'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profiler';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['project_id', 'type', 'message_id', 'duration'], 'required'],
            [['type'], function($attribute, $params) {
                if (!array_key_exists($this->$attribute, $this->_typeList)) {
                    $this->addError($attribute, 'Type message not found');
                }
            }],
            [['date_create', 'date_update'], 'date', 'format' => 'yyyy-MM-dd H:m:s'],
            [['project_id', 'type', 'duration', 'time_start', 'time_end', 'message_id'], 'integer']
        ];
    }

    /**
     * Генерируем пароль, сессионный ключ и дату создания при создании нового пользователя
     * @inheritDoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord and !isset($this->date_create)) {
            $this->date_create = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd H:m:s');
        }

        $this->date_update = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd H:m:s');

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'project_id' => 'Project ID',
            'type' => 'Type',
            'message_id' => 'Message ID',
            'duration' => 'Duration',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
        ];
    }
}
