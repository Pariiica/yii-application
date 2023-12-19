<?php

namespace common\widgets;

use yii\base\Widget;
use common\traits\StatusTrait;

class Status extends Widget
{
    public $status;
    public function init(){
        parent::init();

    }
    public function run()
    {
        return $this->status;
    }
}