<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Status extends Widget
{
    public $status;

    public $icons = [
        'active'=> '<img src="https://img.icons8.com/emoji/32/check-mark-emoji.png" alt="active"/>',
        'inactive' => '<img src="https://img.icons8.com/color/32/delete-sign--v1.png" alt="inactive"/>',
        'pending' => '<img src="https://img.icons8.com/ios/32/228BE6/present.png" alt="pending"/>'
    ];
    public function run()
    {
        if ($this->status === \common\dictionaries\Status::STATUS_ACTIVE) {
            return Html::a($this->icons['active'],'');
        } elseif ($this->status === \common\dictionaries\Status::STATUS_INACTIVE) {
            return Html::a($this->icons['active'],'');
        } else {
            return Html::a($this->icons['pending'],'');
        }
    }
}