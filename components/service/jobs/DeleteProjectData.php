<?php
/**
 * DeleteProjectData.php
 *
 * @package app\components\service\jobs
 * @date: 13.10.2015 20:50
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\service\jobs;

use app\models\amop\commands\LastActiveDate;
use app\models\amop\models\ListProfiler\command\DeleteProfilerList;
use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
use GearmanJob;
use shakura\yii2\gearman\JobBase;
use yii\helpers\ArrayHelper;

/**
 * Воркер удаления данных проекта
 * Class DeleteProjectData
 * @package app\components\service\jobs
 */
class DeleteProjectData extends JobBase
{
    /**
     * @param GearmanJob|null $job
     * @return mixed
     */
    public function execute(GearmanJob $job = null) {

        $data = $data = $this->getWorkload($job)->getParams()['data'];
        $id = $data['id'];
        $staff = $data['staff_id'];

        if (!is_int($id) or !is_int($staff)) {
            $job->sendStatus(400, 400);
            return false;
        }

        // Удаление из кеша даты последнего просмотра пользователем профайлеров проекта
        $profiler = ListProfiler::findAll(['project_id' => $id]);
        $profilerId = ArrayHelper::getColumn($profiler, 'id');

        LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)
            ->setData($profilerId)
            ->setUserId($staff)
            ->delete();

        // Удаление списка профайлеров проекта
        ListProfiler::deleteAll(['project_id' => $id]);

        // Удаление данных проекта
        Profiler::deleteAll(['project_id' => $id]);

        // Удаление из кеша списка профайлеров проекта
        $command = new DeleteProfilerList();
        $command->setData($id)->execute();

        $job->sendStatus(200, 200);
        return true;
    }

}