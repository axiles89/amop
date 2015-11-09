<?php


namespace tests\codeception\unit\models\form\login;

use app\models\form\login\LoginForm;
use Codeception\Specify;
use tests\codeception\unit\fixtures\models\amop\models\UserFixture;

class LoginFormTest extends \yii\codeception\TestCase
{
    use Specify;

    /**
     * Подключение нужных фикстур
     * @return array
     */
    public function fixtures()
    {
        return [
            'user' => UserFixture::className(),
        ];
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }


    /**
     * Валидация пароля в форме
     */
    public function testValidatePassword() {

        $this->specifyConfig()
            ->cloneOnly('db', 'components');

        $this->specify('validate password (success)', function(){
            $model = new LoginForm();
            $model->email = $this->getFixture('user')->getModel('user1')->email;
            $model->password = 'dm1989';
            $model->validate();

            $this->assertNotContains('Неверная почта или пароль.', $model->getErrors('password'));

        });

        $this->specify('validate password (error email)', function() {
            $model = new LoginForm();
            $model->email = "ddd@mail.ru";
            $model->password = 'dm1989';
            $model->validate();

            $this->assertContains('Неверная почта или пароль.', $model->getErrors('password'));
        });

        $this->specify('validate password (error password)', function() {
            $model = new LoginForm();
            $model->email = "ddd@mail.ru";
            $model->password = 'dm19891';
            $model->validate();

            $this->assertContains('Неверная почта или пароль.', $model->getErrors('password'));
        });
    }

    /**
     * Тест методов валидации
     */
    public function testValidate()
    {
        $this->specifyConfig()
            ->cloneOnly('db', 'components');

        $model = new LoginForm();

        $this->specify("validate latin word", function() use ($model) {
            $model->password = "вв";
            $model->validate();

            $this->assertContains('Поле должно содержать латинские буквы или цифры.', $model->getErrors('password'));

            $model->password = "123";
            $model->validate();

            $this->assertNotContains('Поле должно содержать латинские буквы или цифры.', $model->getErrors('password'));
        });

    }




}