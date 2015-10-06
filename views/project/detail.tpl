{use class="yii\helpers\Html"}
{use class="yii\grid\GridView"}
{use class="app\components\widget\config\gridView\ProfilerListConfig"}

{title}{$model->title} | Просмотр проекта{/title}



<section class="content-header">
    <h1>
        {$model->title}
        <small>Детальный просмотр проекта</small>
    </h1>
</section>

<div class="col-lg-9">
    <div class="box box-default box-data">
        <div class="box-header with-border">
            <h3 class="box-title">Список профайлеров</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {GridView::widget(ProfilerListConfig::getData($data))}
        </div>
    </div>
</div>

<div class="col-lg-3">

    <div class="box box-default box-data">
        <div class="box-body">
            <h3 class="text-center box-data profile-username">{$model->title}</h3>
            <p class="text-muted text-center">{$model->description}</p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Профайлеров</b> <a class="pull-right">{$total}</a>
                </li>
            </ul>


            {Html::a('Редактировать', "/project/edit/{$model->id}",  ['class' => 'btn btn-default btn-block btn-sm'])}
        </div>
    </div>

</div>