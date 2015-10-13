{use class="yii\helpers\Html"}

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