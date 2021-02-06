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
    function randStr($length)
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




