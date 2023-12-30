<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Status extends Widget
{
    public $status;

    public $model;
    public $icons = [
        'active'=> '<img src="https://img.icons8.com/emoji/32/check-mark-emoji.png" alt="active"/>',
        'inactive' => '<img src="https://img.icons8.com/color/32/delete-sign--v1.png" alt="inactive"/>',
        'pending' => '<img src="https://img.icons8.com/ios/32/228BE6/present.png" alt="pending"/>'
    ];
    public function run()
    {
        if ($this->model->status === \common\dictionaries\Status::STATUS_ACTIVE) {
            return Html::a($this->icons['active'],['/video/change-status', 'id' => $this->model->id, 'status' => \common\dictionaries\Status::STATUS_INACTIVE]);
        } elseif ($this->model->status === \common\dictionaries\Status::STATUS_INACTIVE) {
            return Html::a($this->icons['inactive'],['/video/change-status', 'id' => $this->model->id, 'status' => \common\dictionaries\Status::STATUS_ACTIVE]);
        } else {
            return Html::a($this->icons['active'],['/video/change-status', 'id' => $this->model->id, 'status' => \common\dictionaries\Status::STATUS_INACTIVE]) . Html::a($this->icons['inactive'],['/video/change-status', 'id' => $this->model->id, 'status' => \common\dictionaries\Status::STATUS_ACTIVE]);
        }
    }
}
