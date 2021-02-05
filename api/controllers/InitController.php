<?php

namespace api\controllers;


use api\controllers\base\BaseController;

/**
 * Init Controller
 */
class InitController extends BaseController
{
    public function actionPost()
    {
        $this->actionSuccess([
            'msg' => '注册成功',
            'data' => [
                'name' => 'ych',
                'age' => 23
            ],
            'extras' => [
                'pid' => 10,
                'suid' => 66
            ],
        ]);

//        $this->actionFail([
//            'msg' => '注册失败',
//            'extras' => [
//                'name' => 'ych',
//                'age' => 23
//            ],
//        ]);
//        $this->actionSuccess('注册成功');
    }


}
