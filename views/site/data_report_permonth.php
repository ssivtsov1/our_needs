<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii \ helpers \ ArrayHelper;
$arr = ['2021','2022','2023'];
$month =array(1 => 'Січень',
    2 => 'Лютий',
    3 => 'Березень',
    4 => 'Квітень',
    5 => 'Травень',
    6 => 'Червень',
    7 => 'Липень',
    8 => 'Серпень',
    9 => 'Вересень',
    10 => 'Жовтень',
    11 => 'Листопад',
    12 => 'Грудень',
);
$model->sql=$sql;
//debug($model);
?>
<div class = 'test col-xs-3' >
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'year')->label('Год')-> textInput() -> dropDownList ($arr)?>

    <?= $form->field($model, 'sql')->label('')-> textInput() ?>

    <?= $form->field($model, 'month')->label('Месяц')  -> textInput() -> dropDownList ($month)?>


    <?= Html::submitButton('OK',['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
