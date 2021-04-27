<?php

use yii\helpers\Html;
$this->title = "Зведений звіт";

?>
<!--<div class="site-about">-->
<!--    <h3>--><?//= Html::encode($this->title) ?><!--</h3>-->
<!--</div>-->

<?php
//debug ($data1);
//return;

$y = count ($data1);
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

<h5 align="center"><b> Зведений звіт про обсяги фактичного споживання </b></h5>
<h5 align="center"><b> електричної енергії на власні потреби </b></h5>
<h5 align="center"><b> ПС 35-150 кВ та РП 6-10 кВ </b></h5>
<h5 align="center"><b> <?php echo 'за'. ' '. mb_strtolower($month[$m], 'UTF-8').' '.$data1[0]['year']. 'р.'.' '. 'в тисячах кВт*год'; ?> </b></h5>
<!--<p>-->
<h6 align="left"><b> Фактичні показники </b></h6>
</div>

<div class="site-spr">
    <table width="600px" class="table table-bordered">
        <tr>
        <th class="th-rep">
            Назва
        </th>
        <th class="th-rep">
            РЕМ
        </th>
        <th class="th-rep">
            <?php
            echo $month[$m];
            ?>
        </th>
        <th class="th-rep">
            ^
        </th>
        </tr>

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
        </table>
        <table id="header-fixed"></table>
</div>

<div class="site-spr">
    <b>
    <p class="leftstr">Директор технічний</p>
    <p class="rightstr">Ю.О. Паршин</p>
    <div style="clear: left"></div>
    </b>

    <h6 align="justify"><b> Дані витягнув з програмного продукту розташованого за адресою 192.168.55.1/our_needs/cek Цемкало І.С.</b></h6>
    <h6 align="justify"><b> тел. 229</b></h6>

</div>
<code><?//= __FILE__ ?></code>

