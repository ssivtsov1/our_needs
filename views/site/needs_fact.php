<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;

$this->title = 'Фактичні показники';
//$this->params['breadcrumbs'][] = $this->title;
?>
<!--<?//= Html::a('Добавити', ['createtransp'], ['class' => 'btn btn-success']) ?>-->
<div class="site-spr">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php if(!isset(Yii::$app->user->identity->role)) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Нічого не знайдено',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
 
//            'tab_nom',
            'nazv',
            'voltage',
            'month_1',
            'month_2',
            'month_3',
            'month_4',
            'month_5',
            'month_6',
            'month_7',
            'month_8',
            'month_9',
            'month_10',
            'month_11',
            'month_12'
//             [
//                /**
//                 * Указываем класс колонки
//                 */
//                'class' => \yii\grid\ActionColumn::class,
//                 'buttons'=>[
//                  'delete'=>function ($url, $model) {
//                        $customurl=Yii::$app->getUrlManager()->createUrl(['/sprav/delete','id'=>$model['id'],'mod'=>'sprtransp']); //$model->id для AR
//                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-remove-circle"></span>', $customurl,
//                                                ['title' => Yii::t('yii', 'Видалити'),'data' => [
//                                                'confirm' => 'Ви впевнені, що хочете видалити цей запис ?',
//                                                ], 'data-pjax' => '0']);
//                  },
//                  
//                  'update'=>function ($url, $model) {
//                        $customurl=Yii::$app->getUrlManager()->createUrl(['/sprav/update','id'=>$model['id'],'mod'=>'sprtransp']); //$model->id для AR
//                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
//                                                ['title' => Yii::t('yii', 'Редагувати'), 'data-pjax' => '0']);
//                  }
//                ],
//                /**
//                 * Определяем набор кнопочек. По умолчанию {view} {update} {delete}
//                 */
//                'template' => '{update} {delete}',
//            ],
        ],
    ]); }?>

</div>



