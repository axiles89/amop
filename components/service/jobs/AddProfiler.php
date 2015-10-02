<?php
/**
 * AddProfiler.php
 *
 * @package app\components\service\jobs
 * @date: 29.09.2015 22:06
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\service\jobs;


use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
use GearmanJob;
use shakura\yii2\gearman\JobBase;

/**
 * todo Сделать сохранение в mongo для дальнейшего расширения логирования
 * Воркер добавления данных профайлера
 * Class AddProfiler
 * @package app\components\service\jobs
 */
class AddProfiler extends JobBase
{
    /**
     * @param GearmanJob|null $job
     * @return mixed
     */
    public function execute(GearmanJob $job = null)
    {
        $data = $this->getWorkload($job)->getParams()['data'];

        // Создаем нужный элемент профилирования
        $listProfiler = ListProfiler::findOne(['message' => $data->message, 'project_id' => $data->project_id]);

        if (!$listProfiler) {
            $listProfiler = new ListProfiler();
            $listProfiler->message = $data->message;
            $listProfiler->project_id = $data->project_id;
        }

        if (!$listProfiler->save()) {
            return false;
        }

        $model = new Profiler();
        $model->date_create =  \Yii::$app->formatter->asDate($data->date_create, 'yyyy-MM-dd H:m:s');
        $model->project_id = $data->project_id;
        $model->type = $data->type;
        $model->message_id = $listProfiler->id;
        $model->duration = $data->duration;
        $model->time_start = $data->time_start;
        $model->time_end = $data->time_end;

        if (!$model->save()) {
            return false;
        }

        return true;
    }


}