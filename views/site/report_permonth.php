<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = "Зведений звіт";

?>
<!--<div class="site-about">-->
<div class=<?= $style_title ?> >
    <h3><?= Html::encode($this->title) ?></h3>
</div>

<table width="600px" class="table table-bordered ">

    <tr>
        <th width="250px">
            <div class="opl_left">
                <span class="span_single">Повідомлення про оплату за послугу по рахунку №
                    <?php
                    echo $model[0]['schet'];
                    ?>
                </span>
                <br>
                <br>
                Одержувач:
                <br>
                <?= Html::encode("ПрАТ «ПЕЕМ «ЦЕК»") ?>
                <br>
                <?= Html::encode("р/р: $rr $mfo") ?>

                <br>
                <?= Html::encode("ЄДРПОУ: $okpo") ?>

                <br>
                <br>
                <?= Html::encode("Платник:") ?>

                <br>
                <?= Html::encode($model[0]['nazv']) ?>

                <br>
                <?= Html::encode($model[0]['addr']) ?>
                <br>
                <br>
                <br>
                <span class="span_single">
                    <?= Html::encode("Сплачено:") ?>

                </span> <span class="span_ramka"> <?= Html::encode($total . ' грн.') ?> </span>
                <br>
                <br>
                <br>
                <?= Html::encode("Підпис") ?>

                <br>
                <br>
            </div>
        </th>
        <th width="350px" class="th_r">
            <div class="opl_left">
                <span class="span_single"><?= Html::encode("Рахунок за послугу №") ?>

                    <? if($model[0]['budget_org']==1): ?>
                        <?= Html::encode('') ?>
                    <? else: ?>
                        <?= Html::encode($model[0]['schet'] . ' від ' . date("d.m.Y", strtotime($model[0]['date']))) ?>
                        <?= Html::encode(' по договору ' . $model[0]['contract']) ?>
                    <? endif; ?>


                </span>
                <br>
                <br>
                <?= Html::encode("Платник:") ?>
                <br>
                <?= Html::encode($model[0]['nazv']) ?>
                <br>
                <?= Html::encode($model[0]['addr']) ?>
                <br>
                <br>
                <?php if ($q == 1): ?>
                    <?= Html::encode("Послуга (призначення платежу):") ?>

                    <br>
                    <?= Html::encode(del_brackets($model[0]['usluga'])) ?>
                    <br>
                    <?= Html::encode("Кiлькiсть калькуляцiйних одиниць: ".$model[0]['kol']) ?>

                    <br>
                    <br>
                    <!--                    <br>-->

                    <?= Html::encode("Сума без ПДВ:") ?>
                    <?= Html::encode($model[0]['summa_beznds']. ' грн.') ?>
                    <br>
                    <?= Html::encode("ПДВ:") ?>
                    <?= Html::encode($model[0]['summa']-$model[0]['summa_beznds']. ' грн.') ?>
                    <br>
                    <br>
                    <span class="span_single">
                        Всього до сплати:
                    </span> <span class="span_ramka">

                        <?= Html::encode($model[0]['summa'] . ' грн.') ?>
                    </span>
                <?php endif; ?>
                <?php if ($q > 1): ?>

                    <table width="350px" class="table table-bordered ">

                        <tr>
                            <th class="th_center" width="85%">
                                <?= Html::encode("Послуга") ?>
                            </th>
                            <th width="15%">
                                <?= Html::encode("Сума, грн.") ?>
                            </th>
                        </tr>
                        <?php for ($i = 0; $i < $q; $i++) { ?>
                            <tr>
                                <td>
                                    <?= Html::encode($model[$i]['usluga']) ?>
                                </td>
                                <td>
                                    <?= Html::encode($model[$i]['summa']) ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br>
                    <br>
                    <br>
                    <span class="span_single">
                        Всього до сплати:
                    </span> <span class="span_ramka">
                        <?= Html::encode($total . ' грн.') ?>
                    </span>
                <?php endif; ?>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <?= Html::encode("Телефон для довідок:    0 800 300 015 (безкоштовно цілодобово)") ?>
                <div class="single_red">
                    <? if(!((int) $model[0]['schet']==9031 || (int) $model[0]['schet']==9030 || (int) $model[0]['schet']==9029)): ?>
                        <?= Html::encode("Рахунок дійсний протягом однієї доби !") ?>
                    <?php endif; ?>
                    <?= Html::encode("В призначенні платежу обов'язково указуйте № рахунку або договору!") ?>
                </div>
                <br>
                <br>

            </div>
        </th>
    </tr>


</table>
<?php
// Данные для QR-кода
$qr = "Рах.№".$model[0]['schet'] . ' від ' . date("d.m.Y", strtotime($model[0]['date'])).
    "|".'№ дог.' . $model[0]['contract']."|"."Платник:".$model[0]['nazv'].
    "|"."Призначення платежу:".$model[0]['usluga'].
    "|"."До сплати:".$model[0]['summa']. ' грн.';


$k=rand(1000000,9999999);
$qr_file="qrlib".$k.".png";
QRcode::png($qr, $qr_file, "H", 10, 5);
?>
<img class="qr_code" src="<?php echo $qr_file?>" alt="QR">
<!--    <a href="#print-this-document" onclick="print(); return false;">Роздрукувати</a>-->
<br>
<br>
<?=
Html::a('Роздрукувати', ['site/sch_print'], [
    'data' => [
        'method' => 'post',
        'params' => [
            'sch' => $model[0]['schet'],
            'sch1' => $model[0]['union_sch'],
        ],],
    'class' => 'btn btn-primary', 'target' => '_blank',]);
?>

<?=
Html::a('Відправити по Email', ['site/sch_email'], [
    'data' => [
        'method' => 'post',
        'params' => [
            'sch' => $model[0]['schet'],
            'sch1' => $model[0]['union_sch'],
            'email' => $model[0]['email'],
        ],],
    'class' => 'btn btn-primary']);
?>


<code><?//= __FILE__ ?></code>

<!--</div>-->
