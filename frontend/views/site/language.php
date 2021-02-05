<?php

use yii\helpers\Html;

$this->title = '切换语言测试';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/language', 'lang' => 'zh_CN']); ?>">中文</a>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/language', 'lang' => 'en']); ?>">English</a>
    <p class="login-box-msg"><?= Yii::t('yii', 'Hello'); ?></p>

</div>