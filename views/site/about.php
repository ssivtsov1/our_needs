<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$zag = $model->title;
$this->title = 'Власні потреби';
//$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="site-about">-->
<div class=<?= $model->style_title ?> >
    <h4><?= Html::encode($zag) ?></h4>
</div>

<div class=<?= $model->style1 ?> >
    <h4><?= Html::encode($model->info1) ?></h4>

</div>

<div class=<?= $model->style2 ?> >

<!--    <h3>--><?//= Html::encode($model->info2) ?><!--</h3>-->
    <span class="span_single">
<!--        --><?//= Html::encode("Що з’явилось нового:") ?>
    </span>

</div>


<code><?//= __FILE__ ?></code>

<!--</div>-->
