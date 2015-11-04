{use class='yii\widgets\ActiveForm' type='block'}
{use class="yii\helpers\Html"}

{title}{$model->title} | Редактирование проекта{/title}



<section class="content-header">
    <h1>
        {$model->title}
        <small>Редактирование проекта в систему Amop</small>
    </h1>
</section>

<div class="box-add-project box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Редактирование проекта</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        {ActiveForm assign='form' id='project-form' method="post"}

            {$form->field($model, 'title', ['options' => ['class' => 'form-group'],
             'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
            ->textInput(['type' => 'text', 'placeholder' => 'Введите название проекта'])}

            {$form->field($model, 'description', ['options' => ['class' => 'form-group'],
            'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
            ->textarea(['style' => ['height' => '100px'], 'placeholder' => 'Введите описание проекта'])}

            {if !isset($model->secret_key)}
                {$form->field($model, 'secret_key', ['options' => ['class' => 'form-group'],
                'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
                ->textInput(['type' => 'text', 'placeholder' => 'Введите секретный ключ', 'value' => $app->getSecurity()->generateRandomString(30), 'readonly' => 'readonly'])}
            {else}
                {$form->field($model, 'secret_key', ['options' => ['class' => 'form-group'],
                'template' => '<label>{label}</label>{input}<div class="help-block">{error}</div>'])
                ->textInput(['type' => 'text', 'placeholder' => 'Введите секретный ключ', 'value' => $model->secret_key, 'readonly' => 'readonly'])}
            {/if}

            <div class="box-footer">

                {Html::a('Удалить', "/project/delete/{$model->id}", ['class' => 'btn btn-danger pull-left', 'name' => 'delete-project-button', 'data-confirm' => 'Действительно удалить проект?'])}

                {Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right', 'name' => 'add-project-button'])}

            </div>

        {/ActiveForm}
    </div>
</div>