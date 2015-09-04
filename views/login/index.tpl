{use class='yii\widgets\ActiveForm' type='block'}
{use class="yii\helpers\Html"}


{title}Авторизация в Amop{/title}

<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Amop</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Введите нужные данные для входа в систему</p>
        {ActiveForm assign='form' id='login-form' action='/form-handler' }

            {$form->field($model, 'email', ['options' => ['class' => 'form-group has-feedback'],
                                'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span> <div class="help-block">{error}</div>'])
                    ->textInput(['type' => 'email', 'placeholder' => $model->getAttributeLabel('email')])}

             {$form->field($model, 'password', ['options' => ['class' => 'form-group has-feedback'],
                                'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span> <div class="help-block">{error}</div>'])
                    ->textInput(['type' => 'password', 'placeholder' => $model->getAttributeLabel('password')])}

            <div class="row">
                <div class="col-xs-8">
                    {$form->field($model, 'rememberMe', ['options' => ['class' => 'checkbox icheck']])->checkbox()}
                </div>
                <div class="col-xs-4">
                    {Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button'])}
                </div>
            </div>

        {/ActiveForm}
        <a href="#">Восстановить пароль</a><br>
        <a href="{path route='login/register'}" class="text-center">Зарегистрироваться</a>
    </div>
</div>


<script>

    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>