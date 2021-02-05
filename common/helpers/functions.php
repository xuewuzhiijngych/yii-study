<?php
if (!function_exists('xx')) {

    function dd(array|string $res)
    {
        echo "<pre>";
        \yii\helpers\VarDumper::dump($res);
    }
}
