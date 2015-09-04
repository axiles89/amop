<?php
/**
 * LoginForm.php
 *
 * @package app\models\form\login
 * @date: 03.09.2015 23:53
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\form\login;


use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

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
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

}