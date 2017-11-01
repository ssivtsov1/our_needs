<?php
// Ввод основных данных для поиска телефонов

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$this->title = '';
?>

<div class="site-login" <?php if(isset(Yii::$app->user->identity->role)) echo 'id="main_block"'; ?>>
    <h2><?= Html::encode($this->title) ?></h2>
      <div class="row">
        <div <?php if(isset(Yii::$app->user->identity->role)) echo 'class="col-lg-8"'; else echo 'class="col-lg-6"'; ?>>
            <?php $form = ActiveForm::begin(['id' => 'inputdata',
                'options' => [
                    'class' => 'form-horizontal col-lg-25',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>

            <?=$form->field($model, 'main_unit')->dropDownList(
                    ArrayHelper::map(app\models\employees::findbysql(
                            "select 607 as id_name,0 as id,null as nazv,'Всі підрозділи' as main_unit
                                union
                                select min(a.id_name) as id_name,b.id,b.nazv,a.main_unit 
                                from vw_phone a 
                                left join spr_res b on a.main_unit = b.nazv
                                group by b.id,b.nazv,a.main_unit")->all(), 'id_name', 'main_unit'),
            [
            'prompt' => 'Виберіть головний підрозділ','onchange' => '$.get("' . Url::to('/phone/web/site/getunit_1?id_name=') .
                '"+$(this).val(),
                    function(data) {
                         $("#inputdata-unit_1").empty();
                         $("#inputdata-unit_2").empty();
   
                         
                         localStorage.setItem("main_unit", data.main_unit);
                         for(var i = 0; i<data.unit.length; i++) {
                         var q = data.unit[i].unit_1;
                         if(q==null) continue;
                         var q1 = q.substr(3);
                         var n = q.substr(0,3);
                         $("#inputdata-unit_1").append("<option value="+n+
                         " style="+String.fromCharCode(34)+"font-size: 14px;"+
                         String.fromCharCode(34)+">"+q1+"</option>");
                        } 
                         $("#inputdata-unit_1").change();
                  });',]); ?>

            <?=$form->field($model, 'unit_1')->
            dropDownList(ArrayHelper::map(
                app\models\employees::findbysql('
                select 607 as id," Всі підрозділи" as unit_1
                union
                Select min(id) as id,unit_1 
                from vw_phone 
                where LENGTH(ltrim(rtrim(unit_1)))<>0
                 group by unit_1 
                 order by unit_1')
                    ->all(), 'id', 'unit_1'),
                ['prompt' => 'Виберіть підрозділ підпорядкований головному',
                    'onchange' => '$.get("' . Url::to('/phone/web/site/getunit?id=') .
                        '"+$(this).val()+"&main_unit="+localStorage.getItem("main_unit"),
                    function(data) {
                         $("#inputdata-unit_2").empty();
                         for(var i = 0; i<data.data.length; i++) {
                         var q = data.data[i].unit_2;
                         if(q==null) continue;
                         var q1 = q.substr(3);
                         var n = q.substr(0,3);
                         $("#inputdata-unit_2").append("<option value="+n+
                         " style="+String.fromCharCode(34)+"font-size: 14px;"+
                         String.fromCharCode(34)+">"+q1+"</option>");
                        } 
                         
                  });',]); ?>

            <?=$form->field($model, 'unit_2')->
            dropDownList(ArrayHelper::map(
                app\models\employees::findbysql('
                select 607 as id," Всі підрозділи" as unit_2
                union
                Select min(id) as id,unit_2 
                from vw_phone 
                where LENGTH(ltrim(rtrim(unit_2)))<>0
                 group by unit_2
                  order by unit_2')
                    ->all(), 'id', 'unit_2'),
                ['prompt' => 'Виберіть підрозділ'
                    ]); ?>

            <?= $form->field($model, 'fio',['inputTemplate' => '<div class="input-group"><span class="input-group-addon">'
            . '<span class="glyphicon glyphicon-user"></span></span>{input}</div>'])
                ->textInput(['onDblClick' => 'rmenu($(this).val(),"#inputdata-fio")'])?>

            <div class='rmenu' id='rmenu-inputdata-fio'></div>

            <?= $form->field($model, 'tel_mob',['inputTemplate' => '<div class="input-group"><span class="input-group-addon">'
            . '<span class="glyphicon glyphicon-phone"></span></span>{input}</div>']) ?>
            <?= $form->field($model, 'tel_town',['inputTemplate' => '<div class="input-group"><span class="input-group-addon">'
                . '<span class="glyphicon glyphicon-phone-alt"></span></span>{input}</div>']) ?>
            <?= $form->field($model, 'tel',['inputTemplate' => '<div class="input-group"><span class="input-group-addon">'
                . '<span class="glyphicon glyphicon-earphone"></span></span>{input}</div>']) ?>
            <?= $form->field($model, 'post')->textInput(['onDblClick' => 'rmenu($(this).val(),"#inputdata-post")']) ?>

            <div class='rmenu' id='rmenu-inputdata-post'></div>

<!--            --><?//= $form->field($model, 'email') ?>

            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-primary','id' => 'btn_find','onclick'=>'dsave()']); ?>
<!--                --><?//= Html::a('OK', ['/CalcWork/web'], ['class' => 'btn btn-success']) ?>
            </div>

            <?php
            
            $session = Yii::$app->session;
            $session->open();
            $session->set('view', 0);
            
            ActiveForm::end(); ?>
        </div>
    </div>
</div>


<script>
    function dsave()
    {

        localStorage.setItem("fio",$('#inputdata-fio').val());
    }


    //window.onload=function(){
    $(document).ready(){
        alert( '1' );

    };
</script>





