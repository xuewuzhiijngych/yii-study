<?php

namespace common\helpers;

use yii\web\Response;

class ResultHelper
{
    static public function Success(array|string $data)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $result['status'] = 1;
        if (isset($data['data'])) {
            $result['data'] = $data['data'] ?? [];
        } else {
            $result['data'] = $data;
        }

        if (is_string($data)) {
            $result['msg'] = strval($data ?? '');
        } elseif (is_array($data)) {
            $result['msg'] = strval($data['msg'] ?? '');
        }

        if (isset($data['extras'])) {
            $result['extras'] = $data['extras'] ?? [];
        }
        \Yii::$app->response->data = $result;
    }

    static public function Fail(array|string $data)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $result['status'] = -1;
        if (isset($data['data'])) {
            $result['data'] = $data['data'] ?? $data;
        } else {
            $result['data'] = $data;
        }

        if (is_string($data)) {
            $result['msg'] = strval($data ?? '');
        } elseif (is_array($data)) {
            $result['msg'] = strval($data['msg'] ?? '');
        }

        if (isset($data['extras'])) {
            $result['extras'] = $data['extras'] ?? [];
        }
        \Yii::$app->response->data = $result;
    }
}

