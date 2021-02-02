
<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Request;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        $flag = 1;
        $main = 0;

        $role=0;
        $department = '';
        if(!isset(Yii::$app->user->identity->role))
        {      $flag=0;}
        else {
            $role = Yii::$app->user->identity->role;
            $department = Yii::$app->user->identity->department;
        }

        NavBar::begin([
                'brandLabel' => 'Власні потреби',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    //'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'navbar-default navbar-fixed-top',
                    
                ],
            ]);
        if($flag){
        switch($role) {
            case 3:  // top
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => Html::tag('span', ' Головна', ['class' => 'glyphicon glyphicon-home']),
                            'url' => ['/site/index']],
                        ['label' => 'Довідники', 'url' => ['/site/index'],
                            'options' => ['id' => 'down_menu'],
                            'items' => [
                                ['label' => 'Норми споживання', 'url' => ['/site/norms_forms']],
//                                ['label' => 'Підстанції', 'url' => ['/site/tp']],
                            ]],
//                        ['label' => 'Звіти', 'url' => ['/site/index'],
//                            'options' => ['id' => 'down_menu'],
//                            'items' => [
//                                ['label' => 'Споживання', 'url' => ['/site/spending']],
//                                ['label' => 'Порівняння норм', 'url' => ['/site/compare']],
//                            ]],
                        ['label' => 'Про програму', 'url' => ['/site/about']],
                        ['label' => 'Вийти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],

                    ],
                    'encodeLabels' => false,
                ]);
                break;
            default:  // top
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => Html::tag('span', ' Головна', ['class' => 'glyphicon glyphicon-home']),
                            'url' => ['/site/index']],
                        ['label' => 'Довідники', 'url' => ['/site/index'],
                            'options' => ['id' => 'down_menu'],
                            'items' => [
                                ['label' => 'Норми споживання', 'url' => ['/site/norms_forms']],
//                                ['label' => 'Підстанції', 'url' => ['/site/tp']],
                            ]],
//                        ['label' => 'Звіти', 'url' => ['/site/index'],
//                            'options' => ['id' => 'down_menu'],
//                            'items' => [
//                                ['label' => 'Споживання', 'url' => ['/site/spending']],
//                                ['label' => 'Порівняння норм', 'url' => ['/site/compare']],
//                            ]],
                        ['label' => 'Про програму', 'url' => ['/site/about']],
                        ['label' => 'Вийти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],

                    ],
                    'encodeLabels' => false,
                ]);
                break;
        }}
           else  {  // other
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
//                        ['label' => Html::tag('span', ' Головна', ['class' => 'glyphicon glyphicon-home']),
//                            'url' => ['/site/index']],
                        ['label' => 'Довідники', 'url' => ['/site/index'],
                            'options' => ['id' => 'down_menu'],
                            'items' => [
                                ['label' => 'Норми споживання', 'url' => ['/site/norms_forms']],
//                                ['label' => 'Підстанції', 'url' => ['/site/tp']],
                            ]],
//                        ['label' => 'Звіти', 'url' => ['/site/index'],
//                            'options' => ['id' => 'down_menu'],
//                            'items' => [
//                                ['label' => 'Споживання', 'url' => ['/site/spending']],
//                                ['label' => 'Порівняння норм', 'url' => ['/site/compare']],
//                            ]],
                        ['label' => 'Про програму', 'url' => ['/site/about']],
                        ['label' => 'Вхід', 'url' => str_replace('/web','',Url::toRoute('site/cek')), 'linkOptions' => ['data-method' => 'post']],
                    ],
                    'encodeLabels' => false,
                ]);

        }

        NavBar::end();
        ?>


        <!--Вывод логотипа-->
        <?php
        $session = Yii::$app->session;
        $session->open();
        if($session->has('view'))
            $view = $session->get('view');
        else
            $view = 0;
        if(!$view){
        ?>
        <? if(!strpos(Yii::$app->request->url,'/cek')): ?>
       
        <? if(strlen(Yii::$app->request->url)==10): ?>
        <img class="logo_site" src="web/Logo.png" alt="ЦЕК" />
        <? endif; ?>

        <? if(strlen(Yii::$app->request->url)<>10): ?>
            <img class="logo_site" src="../Logo.png" alt="ЦЕК" />
        <? endif; ?>
        <? endif; ?>

        <? if(strpos(Yii::$app->request->url,'/cek')): ?>
            <? if(strlen(Yii::$app->request->url)==10): ?>
                <img class="logo_site" src="web/Logo.png" alt="ЦЕК" />
            <? endif; ?>

            <? if(strlen(Yii::$app->request->url)<>10): ?>
                <img class="logo_site" src="../Logo.png" alt="ЦЕК" />
            <? endif; ?>
        <? endif; }?>



        <div class="container">

            <div class="page-header">
                <small class="text-info">
                    <?php
                   
                    if(isset($this->params['admin'] ))
                        if(isset($this->params['res'] ))
                        //echo $this->params['admin'][0] . ' '. $this->params['res'][0];
                           // echo $main;
                    ?>
                    </small>

            </div>

            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Головна', 'url' => '/info'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ;
//           echo  str_replace('/web','',Url::toRoute('site/cek'));
            ?>

            <div class="page-header">
                <small class="text-info">Ви зайшли як: <mark><?php echo $department; ?></mark> </small></h1>
            </div>
             
            <?= $content ?>
            <br>
            
            
        </div>
        <section class="hero_area">
        </section>  

    </div>
 
    <footer class="footer">
        
        <div id="container_footer" class="container">
            <p class="pull-left">&copy; ЦЕК <?= date('Y') ?> &nbsp &nbsp
            <?= Html::a('Головна',["index"],['class' => 'a_main']); ?> &nbsp &nbsp
            <?= Html::a("<a class='a_main' href='http://cek.dp.ua'>сайт ПрАТ ПЕЕМ ЦЕК</a>"); ?>
            </p>
            <p class="pull-right">
            <img class='footer_img' src="../Logo.png">
            </p>
            <?php
                $day = date('j');
                $month = date('n');
                $day_week = date('w');
                switch ($day_week)  {
                    case 0: 
                        $dw = 'нед.';
                        break;
                    case 1: 
                        $dw = 'пон.';
                        break;
                    case 2: 
                        $dw = 'вівт.';
                        break;
                    case 3: 
                        $dw = 'середа';
                        break;
                    case 4: 
                        $dw = 'четв.';
                        break;
                    case 5: 
                        $dw = 'п’ятн.';
                        break;
                    case 6: 
                        $dw = 'суб.';
                        break;
                    
                }    
                $day = $day.' '.$dw;
            ?>
            
            <table width="100%" class="table table-condensed" id="calendar_footer">
            <tr>
                <th width="8.33%">
                    <?php
                    if($month==1) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                   
                </th> 
                <th width="8.33%">
                    <?php
                    if($month==2) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th> 
                <th width="8.33%">
                   <?php
                    if($month==3) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th> 
                <th width="8.33%">
                    <?php
                    if($month==4) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                    <?php
                    if($month==5) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                    <?php
                    if($month==6) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                    <?php
                    if($month==7) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                    <?php
                    if($month==8) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                    <?php
                    if($month==9) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                     <?php
                    if($month==10) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                     <?php
                    if($month==11) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                <th width="8.33%">
                     <?php
                    if($month==12) echo '<div id="on_ceil">'.$day.'</div>';
                    ?>
                </th>
                </tr>
                <tr>
                    
                <td>   
                     <?= Html::encode("січень") ?>
                </td> 
                <td>
                     <?= Html::encode("лютий") ?>
                </td> 
                <td>
                     <?= Html::encode("березень") ?>
                </td> 
                <td>
                     <?= Html::encode("квітень") ?>
                </td>
                <td>
                     <?= Html::encode("травень") ?>
                </td>
                <td>
                     <?= Html::encode("червень") ?>
                </td>
                <td>
                     <?= Html::encode("липень") ?>
                </td>
                <td>
                     <?= Html::encode("серпень") ?>
                </td>
                <td>
                     <?= Html::encode("вересень") ?>
                </td>
                <td>
                     <?= Html::encode("жовтень") ?>
                </td>
                <td >
                     <?= Html::encode("листопад") ?>
                </td>
                <td>
                     <?= Html::encode("грудень") ?>
                </td>
               </tr>

                
            </table>  
            
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
