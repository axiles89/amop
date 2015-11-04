<?php
/**
 * DeleteListProfileData.php
 *
 * @package app\components\service\jobs
 * @date: 04.11.2015 15:49
 * @author: Dianov German <es_dianoff@yahoo.com>
 */

namespace app\components\service\jobs;

use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
use GearmanJob;
use shakura\yii2\gearman\JobBase;
use app\models\amop\models\ListProfiler\command\DeleteProfilerList;

/**
 * Worker for delete list profile data
 * class DeleteListProfileData
 * @package app\components\service\jobs
 */

class DeleteListProfileData extends JobBase
{
    
    /**
     * @param GearmanJob|null $job
     * @return mixed
     */
    public function execute(GearmanJob $job = null) {
        $data = $this->getWorkload($job)->getParams()['data'];
        
        if (!isset($data['id']) or !isset($data['project_id']) or !is_int($data['id']) or !is_int($data['project_id'])) {
            $job->sendStatus(400, 400);
            return false;
        }
        
        $id = $data['id'];
        $project_id = $data['project_id'];
        
        Profiler::deleteAll(['message_id' => $id]);
        
        $command = new DeleteProfilerList();
        $command->setData($project_id)->execute();
        
        $job->sendStatus(200, 200);
        
        return true;
    }
}