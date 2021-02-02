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
$role = Yii::$app->user->identity->role;
//debug(date('m'))
//debug($model->month_1);
//debug((((int) date('m'))-1));

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
    <div class="col-lg-4">
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
    <? if($role==3 || (((int) date('m'))-1)==1):?>
        <?= $form->field($model, 'month_1')->textInput() ?>
    <? else: ?>
        <?= $form->field($model, 'month_1')->textInput(['disabled' => true]) ?>
    <? endif; ?>

        <? if($model->delta_1>0): ?>
        <span class="badge badge-danger  delta_n1">
                <?php
                echo $model->delta_1;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_1<=0): ?>
            <span class="badge badge-secondary delta_n1">
                <?php
                echo $model->delta_1;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--    --><?//= $form->field($model, 'month_2')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==2):?>
            <?= $form->field($model, 'month_2')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_2')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_2>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_2;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_2<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_2;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>

<!--    --><?//= $form->field($model, 'month_3')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==3):?>
            <?= $form->field($model, 'month_3')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_3')->textInput(['disabled' => true]) ?>
        <? endif; ?>

        <? if($model->delta_3>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_3;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_3<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_3;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--    --><?//= $form->field($model, 'month_4')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==4):?>
            <?= $form->field($model, 'month_4')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_4')->textInput(['disabled' => true]) ?>
        <? endif; ?>

        <? if($model->delta_4>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_4;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_4<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_4;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--    --><?//= $form->field($model, 'month_5')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==5):?>
            <?= $form->field($model, 'month_5')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_5')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_5>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_5;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_5<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_5;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--    --><?//= $form->field($model, 'month_6')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==6):?>
            <?= $form->field($model, 'month_6')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_6')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_6>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_6;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_6<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_6;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--        --><?//= $form->field($model, 'month_7')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==7):?>
            <?= $form->field($model, 'month_7')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_7')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_7>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_7;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_7<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_7;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--        --><?//= $form->field($model, 'month_8')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==8):?>
            <?= $form->field($model, 'month_8')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_8')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_8>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_8;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_8<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_8;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--        --><?//= $form->field($model, 'month_9')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==9):?>
            <?= $form->field($model, 'month_9')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_9')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_9>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_9;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_9<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_9;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--        --><?//= $form->field($model, 'month_10')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==10):?>
            <?= $form->field($model, 'month_10')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_10')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_10>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_10;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_10<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_10;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--        --><?//= $form->field($model, 'month_11')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==11):?>
            <?= $form->field($model, 'month_11')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_11')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_11>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_11;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_11<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_11;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>
<!--        --><?//= $form->field($model, 'month_12')->textInput() ?>
        <? if($role==3 || (((int) date('m'))-1)==0):?>
            <?= $form->field($model, 'month_12')->textInput() ?>
        <? else: ?>
            <?= $form->field($model, 'month_12')->textInput(['disabled' => true]) ?>
        <? endif; ?>
        <? if($model->delta_12>0): ?>
            <span class="badge badge-danger  delta_n">
                <?php
                echo $model->delta_12;
                ?>
             </span>
        <? endif; ?>
        <? if($model->delta_12<=0): ?>
            <span class="badge badge-secondary delta_n">
                <?php
                echo $model->delta_12;
                ?>
             </span>
        <? endif; ?>
        <div class="clearfix"></div>


        <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ОК' : 'OK', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>


