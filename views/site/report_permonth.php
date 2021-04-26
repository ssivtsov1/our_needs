<?php

use yii\helpers\Html;
$this->title = "Зведений звіт";

?>
<!--<div class="site-about">-->
<!--    <h3>--><?//= Html::encode($this->title) ?><!--</h3>-->
<!--</div>-->

<?php //debug ($data);
//return;
$y = count ($data1);
$m = $model->month;
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
//debug ($data1);
//return
?>
<div class="site-spr">
<table width="600px" class="table table-bordered ">

    <th>
        Назва
    </th>
    <th>
        РЕМ
    </th>
    <th>
        <?php
        echo $month[$m];
        ?>
    </th>
    <th>
        ^
    </th>

    <?php
    $u=-1;
    for ($i=0; $i<$y; $i++){
        $d = $data1[$i];
//debug ($d);
        $j=0;
    ?>
         <tr>
        <?php
        foreach ($d as $k=>$v) {
                if(mb_substr($v,0,6,'UTF-8')=='Усього') {
                    $u = $i;
                    $class='itog';
                }
                else {
                    if($u==$i) $class='itog';
                    else $class='usual';
                }
                if ($k == 'nazv'): ?>
                <td class="<?php echo($class) ?>">
                    <? echo ($v);
                endif;
                    ?>
                </td>
                <?php  if ($k == 'res'):?>
                <td class="<?php echo($class) ?>">
                    <? echo ($v);
                     endif; ?>
                </td>
            <?php  if ($k == 'month_'.$m):?>
                <td class="<?php echo($class) ?>">
                <? echo ($v);
            endif; ?>
            </td>
            <?php  if ($k == 'delta_'.$m):?>
                <td class="<?php echo($class) ?>">
                <? echo ($v);
            endif; ?>
            </td>


        <?php
            $j++;
        }?>
         </tr>
        <?php
    }
    ?>
    <table id="header-fixed"></table>
</div>
