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
        if (!$url) {
            return null;
        }
        if (!is_string($url)) {
            return null;
        }
        if (strpos($url, 'https://') == false || strpos($url, 'http://') == false) {
            return $url;
        } else {
            return Url::to('/uploads', true) . strval($url);
        }
    }
}