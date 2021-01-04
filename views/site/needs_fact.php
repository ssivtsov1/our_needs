<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;

$this->title = 'Фактичні показники в тисячах кВт.';
//$this->params['breadcrumbs'][] = $this->title;
?>
<!--<?//= Html::a('Добавити', ['createtransp'], ['class' => 'btn btn-success']) ?>-->
<div class="site-spr">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php if(!isset(Yii::$app->user->identity->role)) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Нічого не знайдено',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' =>'nazv',
                'value' => function ($model) {

                    if ( $model->delta_1>0 || $model->delta_2>0 || $model->delta_3>0 || $model->delta_4>0
                        || $model->delta_5>0 || $model->delta_6>0 || $model->delta_7>0 || $model->delta_8>0
                        || $model->delta_9>0 || $model->delta_10>0 || $model->delta_11>0 || $model->delta_12>0)
                        return "<span class='text-info'> $model->nazv </span>";
                    else
                        return $model->nazv;
                },
                'format' => 'raw'

            ],
            'res',
            'month_1',
            ['attribute' =>'delta_1',
                'value' => function ($model) {
                    $q = $model->delta_1;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_1 </span>";
                    else
                        return $model->delta_1;
                },
                'format' => 'raw'

            ],
            'month_2',
            ['attribute' =>'delta_2',
                'value' => function ($model) {
                    $q = $model->delta_2;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_2 </span>";
                    else
                        return $model->delta_2;
                },
                'format' => 'raw'
            ],
            'month_3',
            ['attribute' =>'delta_3',
                'value' => function ($model) {
                    $q = $model->delta_3;
                    if ($q>0)
                         return "<span class='text-info'> $model->delta_3 </span>";
                    else
                        return $model->delta_3;
                },
                'format' => 'raw'

            ],
            'month_4',
            ['attribute' =>'delta_4',
                'value' => function ($model) {
                    $q = $model->delta_4;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_4 </span>";
                    else
                        return $model->delta_4;
                },
                'format' => 'raw'

            ],
            'month_5',
            ['attribute' =>'delta_5',
                'value' => function ($model) {
                    $q = $model->delta_5;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_5 </span>";
                    else
                        return $model->delta_5;
                },
                'format' => 'raw'

            ],
            'month_6',
            ['attribute' =>'delta_6',
                'value' => function ($model) {
                    $q = $model->delta_6;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_6 </span>";
                    else
                        return $model->delta_6;
                },
                'format' => 'raw'
            ],
            'month_7',
            ['attribute' =>'delta_7',
                'value' => function ($model) {
                    $q = $model->delta_7;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_7 </span>";
                    else
                        return $model->delta_7;
                },
                'format' => 'raw'

            ],
            'month_8',
            ['attribute' =>'delta_8',
                'value' => function ($model) {
                    $q = $model->delta_8;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_8 </span>";
                    else
                        return $model->delta_8;
                },
                'format' => 'raw'

            ],
            'month_9',
            ['attribute' =>'delta_9',
                'value' => function ($model) {
                    $q = $model->delta_9;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_9 </span>";
                    else
                        return $model->delta_9;
                },
                'format' => 'raw'

            ],
            'month_10',
            ['attribute' =>'delta_10',
                'value' => function ($model) {
                    $q = $model->delta_10;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_10 </span>";
                    else
                        return $model->delta_10;
                },
                'format' => 'raw'

            ],
            'month_11',
            ['attribute' =>'delta_11',
                'value' => function ($model) {
                    $q = $model->delta_11;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_11 </span>";
                    else
                        return $model->delta_11;
                },
                'format' => 'raw'

            ],
            'month_12',
            ['attribute' =>'delta_12',
                'value' => function ($model) {
                    $q = $model->delta_12;
                    if ($q>0)
                        return "<span class='text-info'> $model->delta_12 </span>";
                    else
                        return $model->delta_12;
                },
                'format' => 'raw'

            ],
            'all_month',
            ['attribute' =>'all_delta',
                'value' => function ($model) {
                    $q = $model->all_delta;
                    if ($q>0)
                        return "<span class='text-info'> $model->all_delta </span>";
                    else
                        return $model->all_delta;
                },
                'format' => 'raw'

            ],
            'voltage',
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



