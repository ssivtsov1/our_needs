<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = "Зведений звіт";

?>
<!--<div class="site-about">-->
<div class=<?= $style_title ?> >
    <h3><?= Html::encode($this->title) ?></h3>
</div>

<?php //debug ($data);
//return;
$y = count ($data);
$m = $model->month;
//debug ($m);
//return
?>

<table width="600px" class="table table-bordered ">

<?php
for ($i=0; $i<$y; $i++){
    $d = $data[$i];
//debug ($d);
for ($j=0; $j<count($d); $j++) {?>
     <tr>
   <?php  if ($j == 1) ?>
         <td>
             <? echo ($d[$j]); ?>
         </td>
   <?php  if ($j == 15) ?>
         <td>
             <? echo ($d[$j]); ?>
         </td>
   <?php  if ($j == ($m+2)) ?>
         <td>
             <? echo ($d[$j]); ?>
         </td>
    </tr>

<?php }} ?>