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

{include '@app/views/project/_profileProject.tpl'}