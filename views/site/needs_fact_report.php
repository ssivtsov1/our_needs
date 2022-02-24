<script>
    window.addEventListener('load', function () {

        var num="<? echo $id; ?>"
        var kol="<? echo $kol; ?>"
        var ScreenHeight = screen.height*0.8;
        // alert(ScreenHeight);
        if(num>13)
            var ki=num/18;
        else
            var ki=num/20.63;

        var shift=ScreenHeight * ki;

        $(this).scrollTop(shift);
        $('table tr').each(function(row){
            $(this).find('td').each(function(cell){
                if(row==num) {
                    $(this).css({"background" : "#30d5c8"});
                }
            });
        });

        var tableOffset = $(".table").offset().top;
        var $header = $(".table > thead").clone();
        var $body = $(".table > tbody").clone();
        var $fixedHeader = $("#header-fixed").append($header);
        $("#header-fixed").width($(".table").width());

        $(window).bind("scroll", function() {
            var offset = $(this).scrollTop();

            if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
                $fixedHeader.show();
            }
            else if (offset < tableOffset) {
                $fixedHeader.hide();
            }

            $("#header-fixed th").each(function(index){
                var index2 = index;
                $(this).width(function(index2){
                    return $(".table th").eq(index).width();
                });
            });
        });

        // alert(111);
        $(window).scroll(function () {
            if(kol<1300) {
                // горизонтальный scroll
                if (window.scrollX > 1)
                    $fixedHeader.hide();
                if (window.scrollX > 270) //270 is the amount of scroll after which the cols should stick
                {
                    left = $(window).scrollLeft() - 15; //15 is the margin from left of fixed columns

                    if(kol>800) {
                        no_columns_to_stick = 4  //stick first 8 columns
                    }
                    else{
                        no_columns_to_stick = 8
                    }

                    $('table td:nth-child(-n+' + no_columns_to_stick + ')').each(function () {
                        $(this).addClass('stick-relative');
                        $(this).css('left', left);
                    });
                    $('table th:nth-child(-n+' + no_columns_to_stick + ')').each(function () {
                        $(this).addClass('stick-relative');
                        $(this).css('left', left);
                    });
                }
                else {
                    $('table td:nth-child(-n+' + no_columns_to_stick + ')').each(function () {
                        $(this).removeClass('stick-relative');
                    });
                    $('table th:nth-child(-n+' + no_columns_to_stick + ')').each(function () {
                        $(this).removeClass('stick-relative');
                    });
                }
            }
        });
    });


</script>


<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
//
//if ($year <> 0)
//    $this->title = 'Фактичні показники в тисячах кВт. ' . $year . ' рік.';
//else
    $this->title = 'Фактичні показники в тисячах кВт.*год ';

//$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$id_user = Yii::$app->user->id;
$day=date('j');
$month=date('n');
$flag_e=0;
if($day<11)  $flag_e=1;
//if($day<12 && $month==3)  $flag_e=1;
if(Yii::$app->user->identity->role==3) $flag_e=1;

echo Html::a('Експорт в Excel', ['site/facts2excel'],
    ['class' => 'btn btn-info excel_btn',
        'data' => [
            'method' => 'post',
            'params' => [

                'data' => $sql,
                'version' => 1
            ],
        ]]);
echo('&nbsp' );
echo('&nbsp' );
echo('&nbsp' );
if(!((isset(Yii::$app->user->identity->role) && $id_user==8) || $flag_e==0))
echo Html::a('Зведений звіт', ['site/rep_permonth'],
['class' => 'btn btn-info excel_btn',
'data' => [
'method' => 'post',
'params' => [

'data' => $sql

],
]]); ?>

<!--<?//= Html::a('Добавити', ['createtransp'], ['class' => 'btn btn-success']) ?>-->
<div class="site-spr">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php if((isset(Yii::$app->user->identity->role) && $id_user==8) || $flag_e==0) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Нічого не знайдено',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            ],
//            [
//                /**
//                 * Указываем класс колонки
//                 */
//                'class' => \yii\grid\ActionColumn::class,
//            'buttons'=>[
//
//                'update'=>function ($url, $model) use ($sql) {
//                    $customurl=Yii::$app->getUrlManager()->
//                    createUrl(['/site/update_fact','id'=>$model['id'],'mod'=>'norm_facts','sql'=>$sql]);
//                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
//                        ['title' => Yii::t('yii', 'Редагувати'), 'data-pjax' => '0']);
//                }
//            ],
//                'template' => '{update}',
//            ],

            ['attribute' =>'nazv',

                'value' => function ($model) {

                    if (( $model->delta_1>0 || $model->delta_2>0 || $model->delta_3>0 || $model->delta_4>0
                        || $model->delta_5>0 || $model->delta_6>0 || $model->delta_7>0 || $model->delta_8>0
                        || $model->delta_9>0 || $model->delta_10>0 || $model->delta_11>0 || $model->delta_12>0)
                        && mb_substr($model->nazv,0,6,'UTF-8') != 'Усього')
                        return "<span class='text-red'> $model->nazv </span>";
                    elseif (( $model->delta_1>0 || $model->delta_2>0 || $model->delta_3>0 || $model->delta_4>0
                            || $model->delta_5>0 || $model->delta_6>0 || $model->delta_7>0 || $model->delta_8>0
                            || $model->delta_9>0 || $model->delta_10>0 || $model->delta_11>0 || $model->delta_12>0)
                        && mb_substr($model->nazv,0,6,'UTF-8') == 'Усього')
                        return "<span class='text-red'> $model->nazv </span>";
                    else
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->nazv </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<em> $model->nazv </em>";
                        else
                            return $model->nazv;
                },
                'format' => 'raw'

            ],
            'voltage',
            'res',
            'year',
            'all_month',
            ['attribute' =>'all_delta',
                'value' => function ($model) {
                    $q = $model->all_delta;
                    if ($q>0)
                        return "<span class='text-red'> $model->all_delta </span>";
                    else
                        return $model->all_delta;
                },
                'format' => 'raw'

            ],
            'month_1',
            ['attribute' =>'delta_1',
                'value' => function ($model) {
                    $q = $model->delta_1;
                    if ($q>0)
                        return "<span class='text-red'> $model->delta_1 </span>";
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
                        return "<span class='text-red'> $model->delta_2 </span>";
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
                         return "<span class='text-red'> $model->delta_3 </span>";
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
                        return "<span class='text-red'> $model->delta_4 </span>";
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
                        return "<span class='text-red'> $model->delta_5 </span>";
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
                        return "<span class='text-red'> $model->delta_6 </span>";
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
                        return "<span class='text-red'> $model->delta_7 </span>";
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
                        return "<span class='text-red'> $model->delta_8 </span>";
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
                        return "<span class='text-red'> $model->delta_9 </span>";
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
                        return "<span class='text-red'> $model->delta_10 </span>";
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
                        return "<span class='text-red'> $model->delta_11 </span>";
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
                        return "<span class='text-red'> $model->delta_12 </span>";
                    else
                        return $model->delta_12;
                },
                'format' => 'raw'

            ],


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

    <?php if(isset(Yii::$app->user->identity->role) && $id_user<>8 && $flag_e==1) { ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'summary' => false,
            'emptyText' => 'Нічого не знайдено',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                 [
                    /**
                     * Указываем класс колонки
                     */
                    'class' => \yii\grid\ActionColumn::class,
                    'buttons'=>[

                        'update'=>function ($url, $model) use ($sql) {
                            $customurl=Yii::$app->getUrlManager()->
                            createUrl(['/site/update_fact','id'=>$model['id'],'mod'=>'norm_facts','sql'=>$sql]);
                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
                                ['title' => Yii::t('yii', 'Редагувати'), 'data-pjax' => '0']);
                        }
                    ],
                    'template' => '{update}',
                ],

                ['attribute' =>'nazv',

                    'value' => function ($model) {

                        if ( $model->delta_1>0 || $model->delta_2>0 || $model->delta_3>0 || $model->delta_4>0
                            || $model->delta_5>0 || $model->delta_6>0 || $model->delta_7>0 || $model->delta_8>0
                            || $model->delta_9>0 || $model->delta_10>0 || $model->delta_11>0 || $model->delta_12>0)
                            return "<span class='text-red'> $model->nazv </span>";
                        else
                            if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                                && mb_strlen($model->nazv,'UTF-8')==7)
                                return "<strong> $model->nazv </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->nazv </em></strong>";
                        else
                            return $model->nazv;
                    },
                    'format' => 'raw'

                ],
//                'voltage',
                ['attribute' =>'voltage',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->voltage </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->voltage </em></strong>";
                        else
                            return $model->voltage;
                    },
                    'format' => 'raw'

                ],
                'res',
                'year',
//                'all_month',
                ['attribute' =>'all_month',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->all_month </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->all_month </em></strong>";
                        else
                            return $model->all_month;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'all_delta',
                    'value' => function ($model) {
                        $q = $model->all_delta;
                        if ($q>0)
                            return "<span class='text-red'> $model->all_delta </span>";
                        else
                            return $model->all_delta;
                    },
                    'format' => 'raw'

                ],
//                'month_1',
                ['attribute' =>'month_1',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_1 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_1 </em></strong>";
                        else
                            return $model->month_1;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_1',
                    'value' => function ($model) {
                        $q = $model->delta_1;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_1 </span>";
                        else {
                            return $model->delta_1;
                        }
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_2',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_2 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_2 </em></strong>";
                        else
                            return $model->month_2;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_2',
                    'value' => function ($model) {
                        $q = $model->delta_2;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_2 </span>";
                        else
                            return $model->delta_2;
                    },
                    'format' => 'raw'
                ],
                ['attribute' =>'month_3',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_3 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_3 </em></strong>";
                        else
                            return $model->month_3;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_3',
                    'value' => function ($model) {
                        $q = $model->delta_3;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_3 </span>";
                        else
                            return $model->delta_3;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_4',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_4 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_4 </em></strong>";
                        else
                            return $model->month_4;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_4',
                    'value' => function ($model) {
                        $q = $model->delta_4;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_4 </span>";
                        else
                            return $model->delta_4;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_5',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_5 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_5 </em></strong>";
                        else
                            return $model->month_5;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_5',
                    'value' => function ($model) {
                        $q = $model->delta_5;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_5 </span>";
                        else
                            return $model->delta_5;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_6',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_6 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_6 </em></strong>";
                        else
                            return $model->month_6;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_6',
                    'value' => function ($model) {
                        $q = $model->delta_6;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_6 </span>";
                        else
                            return $model->delta_6;
                    },
                    'format' => 'raw'
                ],
                ['attribute' =>'month_7',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_7 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_7 </em></strong>";
                        else
                            return $model->month_7;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_7',
                    'value' => function ($model) {
                        $q = $model->delta_7;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_7 </span>";
                        else
                            return $model->delta_7;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_8',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_8 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_8 </em></strong>";
                        else
                            return $model->month_8;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_8',
                    'value' => function ($model) {
                        $q = $model->delta_8;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_8 </span>";
                        else
                            return $model->delta_8;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_9',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_9 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_9 </em></strong>";
                        else
                            return $model->month_9;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_9',
                    'value' => function ($model) {
                        $q = $model->delta_9;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_9 </span>";
                        else
                            return $model->delta_9;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_10',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_10 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_10 </em></strong>";
                        else
                            return $model->month_10;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_10',
                    'value' => function ($model) {
                        $q = $model->delta_10;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_10 </span>";
                        else
                            return $model->delta_10;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_11',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_11 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_11 </em></strong>";
                        else
                            return $model->month_11;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_11',
                    'value' => function ($model) {
                        $q = $model->delta_11;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_11 </span>";
                        else
                            return $model->delta_11;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'month_12',
                    'value' => function ($model) {
                        if (mb_substr($model->nazv,0,7,'UTF-8') == 'Усього:'
                            && mb_strlen($model->nazv,'UTF-8')==7)
                            return "<strong> $model->month_12 </strong>";
                        if (mb_substr($model->nazv,0,6,'UTF-8') == 'Усього'
                            && mb_strlen($model->nazv,'UTF-8')>7)
                            return "<strong><em> $model->month_12 </em></strong>";
                        else
                            return $model->month_12;
                    },
                    'format' => 'raw'

                ],
                ['attribute' =>'delta_12',
                    'value' => function ($model) {
                        $q = $model->delta_12;
                        if ($q>0)
                            return "<span class='text-red'> $model->delta_12 </span>";
                        else
                            return $model->delta_12;
                    },
                    'format' => 'raw'

                ],


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
    <table id="header-fixed"></table>
</div>



