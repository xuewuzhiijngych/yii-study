<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '登录';
?>

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">H+</h1>
        </div>

        <h3>欢迎使用 xx</h3>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')
            ->textInput(['autofocus' => true, 'placeholder' => '用户名'])
            ->label(false)
        ?>

        <?= $form->field($model, 'password')
            ->textInput(['autofocus' => true, 'placeholder' => '密码'])
            ->label(false)
        ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>