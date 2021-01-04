<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\grid\SerialColumn;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-spr1">

    <h3><?= Html::encode($this->title) ?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Нічого не знайдено',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nazv',
            'rem',
            'voltage',
            'mon_1',
            'mon_2',
            'mon_3',
            'mon_4',
            'mon_5',
            'mon_6',
            'mon_7',
            'mon_8',
            'mon_9',
            'mon_10',
            'mon_11',
            'mon_12',
            'year',
        ],
    ]); ?>



</div>





