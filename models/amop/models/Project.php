<?php

namespace app\models\amop\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $date_create
 * @property string $date_update
 * @property string $title
 * @property integer $staff_id
 * @property string $description
 * @property string $secret_key
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['title', 'staff_id'], 'required', 'message' => 'Заполните обязательные поля'],
            [['date_create', 'date_update'], 'date', 'format' => 'yyyy-MM-dd H:m:s'],
            [['title', 'description'], 'string', 'message' => 'Введите верное значение'],
            [['staff_id'], 'integer'],
            [['secret_key'], 'string', 'max' => 30, 'tooLong' => 'Максимальная длина 30 символов'],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff() {
        return $this->hasOne(User::className(), ['id' => 'staff_id']);
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
            'title' => 'Название',
            'staff_id' => 'Staff ID',
            'description' => 'Описание',
            'secret_key' => 'Секретный ключ',
        ];
    }
}
