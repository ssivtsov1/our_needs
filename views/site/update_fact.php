<?php
//debug($model);
//namespace app\models;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\spr_res;
use app\models\status_sch;
//$role = Yii::$app->user->identity->role;
//debug($model)

?>
<script>
   window.onload=function(){
    $(document).click(function(e){

	  if ($(e.target).closest("#recode-menu").length) return;

	   $("#rmenu").hide();

	  e.stopPropagation();

	  });
   }        
</script>

<br>
<div class="row">
    <div class="col-lg-6">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,]); ?>

        <span class="badge">
                <?php
                echo $model->res;
                 ?>
             </span>

    <?= $form->field($model, 'nazv')->textInput(['disabled' => true]) ?>
<!--    --><?//= $form->field($model, 'res')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'month_1')->textInput() ?>
    <?= $form->field($model, 'month_2')->textInput() ?>
    <?= $form->field($model, 'month_3')->textInput() ?>
    <?= $form->field($model, 'month_4')->textInput() ?>
    <?= $form->field($model, 'month_5')->textInput() ?>
    <?= $form->field($model, 'month_6')->textInput() ?>
        <?= $form->field($model, 'month_7')->textInput() ?>
        <?= $form->field($model, 'month_8')->textInput() ?>
        <?= $form->field($model, 'month_9')->textInput() ?>
        <?= $form->field($model, 'month_10')->textInput() ?>
        <?= $form->field($model, 'month_11')->textInput() ?>
        <?= $form->field($model, 'month_12')->textInput() ?>


        <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ОК' : 'OK', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>


