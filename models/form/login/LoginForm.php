<?php
/**
 * LoginForm.php
 *
 * @package app\models\form\login
 * @date: 03.09.2015 23:53
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\form\login;


use app\models\amop\models\User;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'message' => 'Заполните обязательные поля'],
            ['email', 'email', 'message' => 'Неверный email'],
            [['password'], function($attribute, $params) {
                if (!preg_match('/^[\w]+$/', $this->$attribute)) {
                    $this->addError($attribute, 'Поле должно содержать латинские буквы или цифры.');
                }
            }],
            ['password', 'validatePassword'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверная почта или пароль.');
            }
        }
    }


    protected function getUser() {
        if ($this->_user === false) {
            $this->_user = User::find()->where(['email' => $this->email])->one();
        }

        return $this->_user;
    }


    public function login() {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            return false;
        }
    }

}