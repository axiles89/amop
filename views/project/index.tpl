{use class="yii\grid\GridView"}
{use class="yii\grid\SerialColumn"}
{use class="app\components\widget\config\gridView\ProjectListConfig"}


{title}Мои проекты{/title}


<section class="content-header">
    <h1>
        Мои проекты
        <small>Список моих проектов</small>
    </h1>
</section>

    <div class="box box-data">
        <div class="box-header with-border">
            <h3 class="box-title">Мои проекты</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

                 <!-- Кеширование первой страницы списка проектов -->
                {if ($this->beginCache("gridview:project:list:{$app->user->id}", ['duration' => $cacheTime, 'enabled' => $cache]))}
                    {GridView::widget(ProjectListConfig::getData($data))}

                    {$this->endCache()}
                {/if}
        </div>
    </div>