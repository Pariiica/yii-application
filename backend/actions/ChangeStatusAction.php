<?php

namespace backend\actions;
use Yii;
use yii\base\InvalidConfigException;


class ChangeStatusAction extends \yii\base\Action
{
    public $findModel;

    /**
     * @param $id
     *
     * @return yii\db\BaseActiveRecord
     * @throws InvalidConfigException
     */
    public function findModel($id)
    {
        if ($this->findModel === null || !is_callable($this->findModel)) {
            throw new InvalidConfigException(get_class($this) . '::$findModel must be set and should be a valid callback.');
        }

        return call_user_func($this->findModel, $id);
    }



    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function run($id, $status)
    {
        $model =$this->findModel($id);
        $model->status = $status;
        $result = $model->save();

        if ($result) {
            Yii::$app->session->setFlash('success', 'is ok');
        } else {
            Yii::$app->session->setFlash('error', 'failed');
        }

        return $this->controller->redirect($this->controller->request->referrer);
    }

    private function findOne(array $array)
    {
    }
}
