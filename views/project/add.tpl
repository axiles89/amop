{use class='yii\widgets\ActiveForm' type='block'}
{use class="yii\helpers\Html"}

{title}Добавление проекта{/title}



<section class="content-header">
    <h1>
        Проекты
        <small>Добавление нужного проекта в систему Amop</small>
    </h1>
</section>

<div class="box-add-project box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Добавление проекта</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        {ActiveForm assign='form' id='project-form' action='/project/add' method="post"}

            {$form->field($model, 'title', ['options' => ['class' => 'form-group'],
             'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
            ->textInput(['type' => 'text', 'placeholder' => 'Введите название проекта'])}

            {$form->field($model, 'description', ['options' => ['class' => 'form-group'],
            'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
            ->textarea(['style' => ['height' => '100px'], 'placeholder' => 'Введите описание проекта'])}

            {$form->field($model, 'secret_key', ['options' => ['class' => 'form-group'],
            'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
            ->textInput(['type' => 'text', 'placeholder' => 'Введите секретный ключ', 'value' => $app->getSecurity()->generateRandomString(30), 'readonly' => 'readonly'])}

            <div class="box-footer">
                {Html::submitButton('Добавить', ['class' => 'btn btn-primary pull-right', 'name' => 'add-project-button'])}
            </div>

        {/ActiveForm}
    </div>
</div>