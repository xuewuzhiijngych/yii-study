<?php
if (!function_exists('dd')) {
    function dd($res)
    {
        echo "<pre>";
        \yii\helpers\VarDumper::dump($res);
        die();
    }
}

if (!function_exists('randStr')) {
    /**
     * 生成随机字符串
     * @param $length
     * @return string
     */
    function randStr($length): string
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }
}




