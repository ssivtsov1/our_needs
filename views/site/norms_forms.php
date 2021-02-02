<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii \ helpers \ ArrayHelper;
$arr = ['- Виберіть рік *-','2021','2020','2019'];
?>
<div class = 'test col-xs-3' >
    <h4>Норми споживання</h4>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'year')->label('Рік') -> textInput() -> dropDownList ($arr) ?>

    <?= Html::submitButton('OK',['class' => 'btn btn-success']) ?>
    <br>
    <br>
    <?php ActiveForm::end() ?>
</div>
