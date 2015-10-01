<?php
/**
 * ProfilerController.php
 *
 * @package app\modules\api\controllers
 * @date: 28.09.2015 22:09
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\modules\api\controllers;


use app\models\amop\models\Project;
use shakura\yii2\gearman\JobWorkload;
use yii\rest\Controller;
use yii\web\HttpException;

/**
 * Api для работы с профайлером
 * Class ProfilerController
 * @package app\modules\api\controllers
 */
class ProfilerController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    /**
     * todo Сделать ограничение на частоту добавления с одного проекта
     * @return array
     * @throws HttpException
     */
    public function actionAdd() {

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if ($this->generateSecretKey($data->projectId.'-'.$data->projectKey) != $data->secretKey) {
            throw new HttpException(400, 'Secret_key is incorrect');
        }

        $project = Project::find()->where(['id' => $data->projectId, 'secret_key' => $data->projectKey])->one();

        if (!$project) {
            throw new HttpException(400, 'Project not found or project_key is incorrect');
        }

        foreach ($data->data as $object) {
            $message = $object;
            $message->date_create = $data->dateCreate;
            $message->project_id = $data->projectId;

            $result = \Yii::$app->gearman->getDispatcher()->background('AddProfiler', new JobWorkload([
                'params' => [
                    'data' => $message
                ]
            ]));
        }

        return ['status' => 200, 'message' => 'Success'];
    }

    /**
     * @param $key
     * @return string
     */
    protected function generateSecretKey($key) {
        return md5($key);
    }
}