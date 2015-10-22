<?php

namespace app\models\amop\models;

use app\models\amop\models\ListProfiler\command\DeleteProfilerList;
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
     * ���������� ���� �������� � ��������� ���� ����������
     * @inheritDoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->date_create = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd H:m:s');
            $command = new DeleteProfilerList();
            $result = $command->setData($this->project_id)->execute();
        }

        $this->date_update = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd H:m:s');

        return parent::beforeSave($insert);
    }


    /**
     * ��������� ������ � ���
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //$command = new SaveInCache();
        //$command->setData($this->attributes)
        //    ->execute();
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
