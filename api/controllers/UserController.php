<?php

namespace api\controllers;


use api\controllers\base\BaseController;
use common\helpers\ResultHelper;
use common\models\Wxapp;

/**
 * User Controller
 */
class UserController extends BaseController
{
    public function actionAuth()
    {
        $wx_data = [];
        $data = \Yii::$app->request->post();
        $res = \Yii::$app->wxapp->auth($data);
        $errmsg = @$res->errmsg;
        if ($errmsg) {
            return Fail($res->errmsg);
        }
        $wx_data['openid'] = $res->openid;
        $wx_data['session_key'] = $res->session_key;
        $user_data = @json_decode($data['user_data'], true);
        if ($user_data['errMsg'] != 'getUserInfo:ok') {
            $this->actionFail($user_data['errMsg']);
        }
        $wx_data = array_merge($wx_data, $user_data['userInfo']);
        ResultHelper::Success($wx_data);
    }

    public function actionGetPhone()
    {
        $data = \Yii::$app->request->post();
        $res = \Yii::$app->wxapp->getPhone($data);
        ResultHelper::Success($res);
    }

}
