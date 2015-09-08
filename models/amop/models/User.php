<?php

namespace app\models\amop\models;

use Yii;
use yii\web\IdentityInterface;

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
class User extends \yii\db\ActiveRecord implements IdentityInterface
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
            [['login'], function($attribute, $params) {
                $user = static::find()->where(['login' => $this->$attribute])->one();

                if ($user) {
                    $this->addError($attribute, "Пользователь с таким логином существует");
                }
            }],
            ['auth_key', 'string'],
            [['date_create'], 'date', 'format' => 'yyyy-MM-dd H:m:s'],
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
     * Генерируем пароль, сессионный ключ и дату создания при создании нового пользователя
     * @inheritDoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->date_create = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd H:m:s');
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
        return parent::beforeSave($insert);
    }

    public function validatePassword($password) {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
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
            'auth_key' => 'Key'
        ];
    }
}
