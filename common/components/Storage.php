<?php

namespace common\components;

use yii\base\Component;
use yii\helpers\Url;

class Storage extends Component
{
    /**
     * 补全 图片url
     * @param string $url
     * @return string|null
     */
    public function storage(string $url): string|null
    {
        if ($url && is_string($url)) {
            return Url::to('/uploads', true) . strval($url);
        } else {
            return null;
        }
    }
}