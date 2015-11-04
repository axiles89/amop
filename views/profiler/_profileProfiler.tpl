{use class="yii\helpers\Html"}

<div class="col-lg-3">

    <div class="box box-default box-data">
        <div class="box-body">
            <h3 class="text-center box-data profile-username">{$profiler->message}</h3>
            <p class="text-muted text-center">Статистика профайлера</p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Сообщений</b> <a class="pull-right">{$totalMessage}</a>
                </li>
                <li class="list-group-item">
                    <b>Проект</b>
                    {Html::a($profiler->project->title, "/project/detail/{$profiler->project->id}",  ['class' => 'pull-right'])}
                </li>
                <li class="list-group-item">
                    <b>Дата создания</b> <a class="pull-right">{$app->formatter->asDate($profiler->date_create, 'dd.MM.yyyy H:m:s')}</a>
                </li>
                <li class="list-group-item">
                    <b>Дата обновления</b> <a class="pull-right">{$app->formatter->asDate($profiler->date_update, 'dd.MM.yyyy H:m:s')}</a>
                </li>
            </ul>
        </div>
    </div>

</div>