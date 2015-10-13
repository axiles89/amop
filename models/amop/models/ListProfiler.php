<?php

namespace app\models\amop\models;

use Yii;

/**
 * This is the model class for table "list_profiler".
 *
 * @property integer $id
 * @property string $date_create
 * @property string $date_update
 * @property integer $project_id
 * @property string $message
 */
class ListProfiler extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_profiler';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['project_id', 'message'], 'required'],
            [['project_id'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject() {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * Генерируем дату создания и обновляем дату обновления
     * @inheritDoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
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
            'message' => 'Message',
        ];
    }
}
