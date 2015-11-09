{use class="app\components\widget\durationGraph\DurationGraph"}
{use class="yii\grid\GridView"}
{use class="app\components\widget\config\gridView\ProfileListDataConfig"}

{title}{$profiler->message} | Просмотр профайлера{/title}


<section class="content-header">
    <h1>
        {$profiler->message}
        <small>Детальный просмотр профайлера</small>
    </h1>
</section>

<div class="col-lg-9">
    <div class="box box-default box-data">
        <div class="box-body">
            {DurationGraph::widget(['messageId' => $profiler->id, 'title' => $profiler->message])}
        </div><!-- /.box-body -->
        <div class="box-body">
             {GridView::widget(ProfileListDataConfig::getData($data))}
        </div><!-- /.box-body -->
    </div>
</div>
{include '@app/views/profiler/_profileProfiler.tpl'}



