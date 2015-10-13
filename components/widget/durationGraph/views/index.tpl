{use class="dosamigos\highcharts\HighCharts"}
{use class='yii\widgets\ActiveForm' type='block'}
{use class="yii\helpers\Html"}
{use class="yii\jui\DatePicker"}



{ActiveForm assign='form' id='durationgraph-filter' action='' method="get" options=['class' => 'form-inline']}

{$form->field($filter, 'date_create_from', ['options' => ['class' => 'form-group datepicker'],
'template' => '{label} &nbsp;{input}'])
->label("c: ")
->widget('yii\jui\DatePicker', [
'dateFormat' => 'yyyy-MM-dd',
'language' => 'ru'
])}

    &nbsp;&nbsp;&nbsp;
{$form->field($filter, 'date_create_to', ['options' => ['class' => 'form-group datepicker'],
'template' => '{label} &nbsp;{input}'])
->label("по: ")
->widget('yii\jui\DatePicker', [
'dateFormat' => 'yyyy-MM-dd',
'language' => 'ru'
])}

{Html::submitButton('Применить', ['class' => 'btn btn-default btn-group btn-sm float-right', 'name' => 'filter-button'])}

{/ActiveForm}



{HighCharts::widget([
'clientOptions' => [
'title' => [
'text' =>  'Время выполнения скрипта'
],
'subtitle' => [
'text' => $title
],
'xAxis' => [
'type'=> 'datetime'
],
'yAxis' =>  [
'title' => [
'text' => 'Время выполнения (миллисекунд)'
],
'plotLines' => [[
'value' => 0,
'width' => 1,
'color' => '#808080'
]]
],
'legend' => [
'layout' => 'vertical',
'align' => 'right',
'verticalAlign' => 'middle',
'borderWidth' => 0
],
'series' => [[
'name' => $title,
'data' => $y
]]
]
])}


