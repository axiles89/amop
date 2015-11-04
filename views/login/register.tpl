{use class='yii\widgets\ActiveForm' type='block'}
{use class="yii\helpers\Html"}


{title}Регистрация в Amop{/title}

<div class="register-box">
    <div class="register-logo">
        <a href="/"><b>Amop</b></a>
    </div>
    <div class="register-box-body">
        <p class="login-box-msg">Регистрация нового пользователя</p>
        {ActiveForm assign='form' id='login-form' action='/login/register' method="post" options=['enctype' => 'multipart/form-data']}

            {$form->field($model, 'login', ['options' => ['class' => 'form-group has-feedback'],
                                'template' => '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span> <div class="help-block">{error}</div>'])
                    ->textInput(['type' => 'text', 'placeholder' => 'Введите логин'])}

            {$form->field($model, 'email', ['options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span> <div class="help-block">{error}</div>'])
            ->textInput(['type' => 'text', 'placeholder' => 'Введите email'])}

            {$form->field($model, 'name', ['options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-star form-control-feedback"></span> <div class="help-block">{error}</div>'])
            ->textInput(['type' => 'text', 'placeholder' => 'Введите имя'])}

            {$form->field($model, 'surname', ['options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-star-empty form-control-feedback"></span> <div class="help-block">{error}</div>'])
            ->textInput(['type' => 'text', 'placeholder' => 'Введите фамилию'])}

             {$form->field($model, 'password', ['options' => ['class' => 'form-group has-feedback'],
                                'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span> <div class="help-block">{error}</div>'])
                    ->textInput(['type' => 'password', 'placeholder' => 'Введите пароль'])}

            {$form->field($model, 'retypePassword', ['options' => ['class' => 'form-group has-feedback'],
            'template' => '{input}<span class="glyphicon glyphicon-log-in form-control-feedback"></span> <div class="help-block">{error}</div>'])
            ->textInput(['type' => 'password', 'placeholder' => 'Повторите пароль'])}

            {$form->field($model, 'imageAvatar', ['options' => ['class' => 'form-group has-feedback'],
            'template' => '{label}{input} <div class="help-block">{error}</div>'])
            ->label("Фотография", ['style' => 'font-weight:normal;'])
            ->fileInput()}

            <div class="row">
                <div class="col-xs-register">
                    {Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'register-button'])}
                </div>
            </div>

        {/ActiveForm}

        <br>
        <a href="{path route='login/index'}" class="text-center">У меня уже есть аккаунт</a>
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