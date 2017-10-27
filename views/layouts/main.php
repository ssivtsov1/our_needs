<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Request;

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

         if(!isset(Yii::$app->user->identity->id_res))
                $flag=0;
         else
             $flag = Yii::$app->user->identity->id_res;

                 

       // die;
        if(isset(Yii::$app->user->identity->role)) {
                $adm = Yii::$app->user->identity->role;
                if ($adm==3)
                {
                    $main=1;
                    $this->params['admin'][] = "Режим адміністратора: ";
                }
                else
                    $this->params['admin'][] = "Режим користувача: ";
         }

       
        if(!isset(Yii::$app->user->identity->role))
            $main=2;
      
        if($main!=1)    
        NavBar::begin([
                'brandLabel' => 'Телефонний довідник',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    //'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'navbar-default navbar-fixed-top',
                    
                ],
            ]);
        else
          NavBar::begin([
                'brandLabel' => 'Телефонний довідник (режим адміністратора)',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    //'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'navbar-default navbar-fixed-top',
                    
                ],
            ]);  


       
       
            switch ($main) {
           

            case 1:
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => Html::tag('span',' Головна',['class' => 'glyphicon glyphicon-home']) ,
                            'url' => ['/site/index']],
                        
                        ['label' => 'Працівники', 'url' => ['/site/employees']],
                        ['label' => 'Про сайт', 'url' => ['/site/about']],
                        ['label' => Html::tag('span',' Вийти',['class' => 'glyphicon glyphicon-log-out']),
                             'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        
                    ],
                    'encodeLabels' => false,
                ]);
                break;
            case 0:
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                       ['label' => 'Головна', 'url' => ['/site/index']],
                        
                        ['label' => 'Працівники', 'url' => ['/site/employees']],
                        ['label' => 'Про сайт', 'url' => ['/site/about']],
                        //['label' => 'Вийти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        /*
                        Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/site/login']] :
                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']],
                         *
                         */
                    ],
                ]);
                break;
            case 2:
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                     
                        ['label' => Html::tag('span',' Головна',['class' => 'glyphicon glyphicon-home']) ,
                            'url' => ['/site/index']],
                        
                        ['label' => 'Працівники', 'url' => ['/site/employees']],
                        ['label' => 'Про сайт', 'url' => ['/site/about']],
                        
                        //['label' => 'Вийти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        /*
                        Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/site/login']] :
                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']],
                         *
                         */
                    ],
                    'encodeLabels' => false,
                ]);
                break;
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
                'homeLink' => ['label' => 'Головна', 'url' => '/phone'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
             
            <?= $content ?>
            
        </div>
        <section class="hero_area">
        </section>  

    </div>
 
    <footer class="footer">
        
        <div class="container">
            <p class="pull-left">&copy; ЦЕК <?= date('Y') ?></p>
            <p class="pull-right"><?//= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
