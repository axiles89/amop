<?php

namespace app\models\amop\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $date_create
 * @property string $login
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $avatar
 */
class User extends \yii\db\ActiveRecord
{
    const SCENARIO_REGISTER = 1;

    public $retypePassword;
    public $imageAvatar;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'name', 'surname', 'email', 'password'], 'required', 'message' => 'Заполните обязательные поля'],
            [['date_create'], 'safe'],
            ['retypePassword', function($attribute, $params){
                if ($this->$attribute != $this->password) {
                    $this->addError($attribute, 'Введите верный повторный пароль');
                }
            }],
            ['imageAvatar', 'image', 'extensions' => 'png, jpg, jpeg', 'wrongExtension' => 'Выберите файл с расширением png, jpg, jpeg', 'checkExtensionByMimeType'=>false, 'skipOnEmpty' => true],
            ['retypePassword', 'required', 'message' => 'Заполните обязательные поля', 'on' => self::SCENARIO_REGISTER],
            [['login'], 'string', 'max' => 10, 'tooLong' => 'Максимальная длина 10 символов'],
            [['name', 'email'], 'string', 'max' => 20, 'tooLong' => 'Максимальная длина 20 символов'],
            [['surname', 'avatar'], 'string', 'max' => 30, 'tooLong' => 'Максимальная длина 30 символов'],
            ['email', 'email', 'message' => 'Неверный email'],
            [['password', 'login', 'retypePassword'], function($attribute, $params) {
                if (!preg_match('/^[\w]+$/', $this->$attribute)) {
                    $this->addError($attribute, 'Поле должно содержать латинские буквы или цифры.');
                }
            }],
            [['name', 'surname'], function($attribute, $params) {
                if (!preg_match('/^[a-zA-ZA-Яа-я]+$/', $this->$attribute)) {
                    $this->addError($attribute, 'Поле должно содержать только буквы.');
                }
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_create' => 'Date Create',
            'login' => 'Login',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'avatar' => 'Avatar',
        ];
    }
}
