<?php
if (!function_exists('xx')) {

    function dd($res)
    {
        echo "<pre>";
        \yii\helpers\VarDumper::dump($res);
        die();
    }
}
