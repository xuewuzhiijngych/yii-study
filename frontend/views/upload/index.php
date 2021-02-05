<?php use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>
<button>提交</button>

<!--<img src='--><?//= $url ?><!--' alt="">-->

<?php ActiveForm::end() ?>




