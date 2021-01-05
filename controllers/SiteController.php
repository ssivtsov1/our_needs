<?php

namespace app\controllers;
//namespace app\models;

use app\models\A_diary;
use app\models\A_diary_search;
use app\models\Norms_search;
use app\models\phones_sap;
use app\models\phones_sap_search;
use app\models\Plan;
use app\models\plan_forma;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\ContactForm;
use app\models\InputData;
use app\models\cdata;
use app\models\needs_fact;
use app\models\vneeds_fact;
use app\models\shtrafbat;
use app\models\viewphone;
use app\models\list_workers;
use app\models\kyivstar;
use app\models\hipatch;
use app\models\tel_vi;
use app\models\requestsearch;
use app\models\tofile;
use app\models\forExcel;
use app\models\info;
use app\models\User;
use app\models\loginform;
use kartik\mpdf\Pdf;
//use mpdf\mpdf;
use yii\web\UploadedFile;
use app\models\Norms;

class SiteController extends Controller
{  /**
 * 
 * @return type
 *
 */

    public $curpage;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    //  Происходит при запуске сайта
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['site/more']);
        }
        if(strpos(Yii::$app->request->url,'/cek')==0)
            return $this->redirect(['site/more']);
        $model = new loginform();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/more']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    //  Происходит после ввода пароля
    public function actionMore($sql='0')
    {
        $this->curpage=1;
        if($sql=='0') {

            $model = new InputData();


            $const_year=date('Y');  //  константа - нужно поменять если будут добавляться года в список
            if ($model->load(Yii::$app->request->post())) {
                // Создание поискового sql выражения
                $where = '';
                if (!empty($model->up)) {
                    $where .= ' and (delta_1>0 or delta_2>0 or delta_3>0  or delta_4>0  or delta_5>0
                     or delta_6>0  or delta_7>0  or delta_8>0  or delta_9>0  or delta_10>0
                      or delta_11>0  or delta_12>0)'   ;
                }
                if (!empty($model->year)) {
                    $year=$const_year-$model->year;
                }
                else
                    $year=$const_year-1;

                if (!empty($model->rem)) {
                    switch ($model->rem){
                        case 1:
                            $where .= ' and rem=' . "'" . '-' ."'" ;
                            break;
                        case 2:
                            $where .= ' and rem=' . "'" . '01' ."'" ;
                            break;
                        case 3:
                            $where .= ' and rem=' . "'" . '03' ."'" ;
                            break;
                        case 4:
                            $where .= ' and rem=' . "'" . '04' ."'" ;
                            break;
                        case 5:
                            $where .= ' and rem=' . "'" . '07' ."'" ;
                            break;
                        case 6:
                            $where .= ' and rem=' . "'" . '02' ."'" ;
                            break;
                        case 7:
                            $where .= ' and rem=' . "'" . '05' ."'" ;
                            break;
                        case 8:
                            $where .= ' and rem=' . "'" . '06' ."'" ;
                            break;
                        case 9:
                            $where .= ' and rem=' . "'" . '08' ."'" ;
                            break;
                        case 10:
                            $where .= ' and rem=' . "'" . '09' ."'" ;
                            break;
                    }

                }
                $where = trim($where);
                if (empty($where)) $where = '';
                else {
                    $where = ' where ' . substr($where, 4) . ' or id=500 ' ;
                }

                $sql = "select * from (
    select a.*,
    (a.month_1+a.month_2+a.month_3+a.month_4+
    a.month_5+a.month_6+a.month_7+a.month_8+
    a.month_9+a.month_10+a.month_11+a.month_12) as all_month,	
    a. month_1-b.mon_1 as delta_1,
    a. month_2-b.mon_2 as delta_2,
    a. month_3-b.mon_3 as delta_3,
    a. month_4-b.mon_4 as delta_4,
    a. month_5-b.mon_5 as delta_5,
    a. month_6-b.mon_6 as delta_6,
    a. month_7-b.mon_7 as delta_7,
    a. month_8-b.mon_8 as delta_8,
    a. month_9-b.mon_9 as delta_9,
    a. month_10-b.mon_10 as delta_10,
    a. month_11-b.mon_11 as delta_11,
    a. month_12-b.mon_12 as delta_12,
    (a. month_1-b.mon_1)+
    (a. month_2-b.mon_2)+
    (a. month_3-b.mon_3)+
    (a. month_4-b.mon_4)+
    (a. month_5-b.mon_5)+
    (a. month_6-b.mon_6)+
    (a. month_7-b.mon_7)+
    (a. month_8-b.mon_8)+
    (a. month_9-b.mon_9)+
    (a. month_10-b.mon_10)+
    (a. month_11-b.mon_11)+
    (a. month_12-b.mon_12) as all_delta,
                            c.rem as res
                            from needs_fact a
                            join needs_norm b on a.nazv=b.nazv and a.rem=b.rem 
                            and a.year=$year and b.year=$year 
                            left join kod_rem c on a.rem=c.kod_rem
                           union all
    select 500 as id,'Усього:' as nazv,
    sum(a.month_1) as month_1,
    sum(a.month_2) as month_2,
    sum(a.month_3) as month_3,
    sum(a.month_4) as month_4,
    sum(a.month_5) as month_5,
    sum(a.month_6) as month_6,
    sum(a.month_7) as month_7,
    sum(a.month_8) as month_8,
    sum(a.month_9) as month_9,
    sum(a.month_10) as month_10,
    sum(a.month_11) as month_11,
    sum(a.month_12) as month_12,
    0 as year,
    '' as rem,
    0 as voltage,
    sum(a.month_1+a.month_2+a.month_3+a.month_4+
        a.month_5+a.month_6+a.month_7+a.month_8+
        a.month_9+a.month_10+a.month_11+a.month_12) as all_month,	
    sum(a. month_1-b.mon_1) as delta_1,
    sum(a. month_2-b.mon_2) as delta_2,
    sum(a. month_3-b.mon_3) as delta_3,
    sum(a. month_4-b.mon_4) as delta_4,
    sum(a. month_5-b.mon_5) as delta_5,
    sum(a. month_6-b.mon_6) as delta_6,
    sum(a. month_7-b.mon_7) as delta_7,
    sum(a. month_8-b.mon_8) as delta_8,
    sum(a. month_9-b.mon_9) as delta_9,
    sum(a. month_10-b.mon_10) as delta_10,
    sum(a. month_11-b.mon_11) as delta_11,
    sum(a. month_12-b.mon_12) as delta_12,
    sum((a. month_1-b.mon_1)+
        (a. month_2-b.mon_2)+
        (a. month_3-b.mon_3)+
        (a. month_4-b.mon_4)+
        (a. month_5-b.mon_5)+
        (a. month_6-b.mon_6)+
        (a. month_7-b.mon_7)+
        (a. month_8-b.mon_8)+
        (a. month_9-b.mon_9)+
        (a. month_10-b.mon_10)+
        (a. month_11-b.mon_11)+
        (a. month_12-b.mon_12)) as all_delta,
    '' as res
    from needs_fact a
    join needs_norm b on a.nazv=b.nazv and a.rem=b.rem ".apply_rem($model->rem).
                    " and a.year=$year and b.year=$year 
    ) s"
    . $where . ' order by voltage desc,rem asc';

//          debug($sql);
//          return;

                $f=fopen('aaa','w+');
                fputs($f,$sql);

                $data = needs_fact::findBySql($sql)->all();
                $kol = count($data);
                $searchModel = new needs_fact();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);

                $dataProvider->pagination = false;

                return $this->render('needs_fact', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel, 'kol' => $kol,'sql' => $sql]);
            } else {

                return $this->render('inputdata', [
                    'model' => $model
                ]);
            }
            }

            
        else{
             // Если передается параметр $sql
            $data = needs_fact::findBySql($sql)->all();
            $searchModel = new needs_fact();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
            $dataProvider->pagination = false;
            $kol = count($data);

            $session = Yii::$app->session;
            $session->open();
            $session->set('view', 1);

            return $this->render('needs_fact', ['data' => $data,
                'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'kol' => $kol, 'sql' => $sql]);
        }
    }

    //    ~ Обновление записи
    public function actionUpdate_fact($id,$mod,$sql,$res='')
    {
        // $id  id записи
        // $mod - название модели
        if($mod=='norm_facts')
            $model = vneeds_fact::find()
                ->where('id=:id', [':id' => $id])->one();


        $session = Yii::$app->session;
        $session->open();
        if($session->has('user'))
            $user = $session->get('user');
        else
            $user = '';

        if ($model->load(Yii::$app->request->post()))
        {
            // Обновление фактических показателей
            $z = "UPDATE needs_fact 
                  SET "."month_1"."=".$model->month_1.
                ',month_2='.$model->month_2.
                ',month_3='.$model->month_3.
                ',month_4='.$model->month_4.
                ',month_5='.$model->month_5.
                ',month_6='.$model->month_6.
                ',month_7='.$model->month_7.
                ',month_8='.$model->month_8.
                ',month_9='.$model->month_9.
                ',month_10='.$model->month_10.
                ',month_11='.$model->month_11.
                ',month_12='.$model->month_12.
                " WHERE id = ".$model->id;

            Yii::$app->db->createCommand($z)->execute();

            if($mod=='norm_facts')
                $this->redirect(['site/more','sql' => $sql]);

        } else {
            if($mod=='norm_facts')
                return $this->render('update_fact', [
                    'model' => $model
                ]);
        }
    }

    public function actionNorms_forms()
    {
        $model = new Norms();
        $searchModel = new Norms_search();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//        debug('1111111111111');
            $sql = "SELECT  nazv,c.rem,voltage,mon_1,mon_2,mon_3,mon_4,mon_5,mon_6,mon_7,mon_8,mon_9,mon_10,mon_11,mon_12,year 
FROM needs_norm 
left join kod_rem c on needs_norm.rem=c.kod_rem
 where 1=1 ";
                if (!empty($model->year)) {
                    if ($model->year == '1')
                        $model->year = '2020';
                    if ($model->year == '2')
                        $model->year = '2019';
                    $sql = $sql . ' and year = ' . $model->year ;
            }
                $sql=$sql. ' ORDER BY needs_norm.voltage desc,needs_norm.rem asc,needs_norm.nazv,needs_norm.year desc';
//                        debug($sql);
//        return;

                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//            debug($sql);
//            return;
                    $dataProvider->pagination = false;
                    return $this->render('norms', [
                        'model' => $searchModel, 'dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'sql' => $sql
                    ]);
        } else {
            return $this->render('norms_forms', compact('model'));
        }
    }

    // Сброс в Excel
    public function actionNorms2excel()
    {
        $sql=Yii::$app->request->post('data');
        $model = Norms_search::findBySql($sql)->asarray()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Norms_search::findBySql($sql),
            'pagination' => [
                'pageSize' => 500,
            ],
        ]);
        $session = Yii::$app->session;
        if($session->has('sql_analytics'))
            $sql = $session->get('sql_analytics');
        else
            $sql='';


        $cols = [
            'nazv'=> 'Назва',
            'rem'=> 'РЕМ',
            'voltage'=> 'Рівень напруги',
            'mon_1'=> 'Січень',
            'mon_2'=> 'Лютий',
            'mon_3'=> 'Березень',
            'mon_4'=> 'Квітень',
            'mon_5'=> 'Травень',
            'mon_6'=> 'Червень',
            'mon_7'=> 'Липень',
            'mon_8'=> 'Серпень',
            'mon_9'=> 'Вересень',
            'mon_10'=> 'Жовтень',
            'mon_11'=> 'Листопад',
            'mon_12'=> 'Грудень',
            'year' => 'Рік'
        ];

        // Формирование массива названий колонок
        $list='';  // Список полей для сброса в Excel
        $h=[];
        $i=0;
//        debug($model);
//        return;
        $j=0;
        $col_e=[];
        foreach($model[0] as $k=>$v){
            $col="'".$k."'";
            $col_e[$j]=$k;
            $j++;
            if(in_array(trim($k), array_keys($cols), true)){
                $h[$i]['col']=$col;
                $i++;
            }
        }


        $k1='Довідник норм';

        $newQuery = clone $dataProvider->query;
        $models = $newQuery->all();

        \moonland\phpexcel\Excel::widget([
            'models' => $models,

            'mode' => 'export', //default value as 'export'
            'format' => 'Excel2007',
            'hap' => $k1,    //cтрока шапки таблицы
            'data_model' => 1,
            //'columns' => $h,
            'columns' => $col_e,
            'headers' => $cols
        ]);
        return;

    }

    // Сброс в Excel
    public function actionFacts2excel()
    {
        $sql=Yii::$app->request->post('data');
        $model = needs_fact::findBySql($sql)->asarray()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => needs_fact::findBySql($sql),
            'pagination' => [
                'pageSize' => 500,
            ],
        ]);
        $session = Yii::$app->session;
        if($session->has('sql_analytics'))
            $sql = $session->get('sql_analytics');
        else
            $sql='';

        $cols = [
            'id' => 'ID',
            'nazv' => 'Назва',
            'month_1' => 'січень',
            'month_2' => 'лютий',
            'month_3' => 'березень',
            'month_4' => 'квітень',
            'month_5' => 'травень',
            'month_6' => 'червень',
            'month_7' => 'липень',
            'month_8' => 'серпень',
            'month_9' => 'вересень',
            'month_10' => 'жовтень',
            'month_11' => 'листопад',
            'month_12' => 'грудень',
            'year' => 'Рік',
            'rem' => '',
            'voltage' => 'Рівень напруги',
            'all_month' => 'Усього',
            'delta_1' => '^1',
            'delta_2' => '^2',
            'delta_3' => '^3',
            'delta_4' => '^4',
            'delta_5' => '^5',
            'delta_6' => '^6',
            'delta_7' => '^7',
            'delta_8' => '^8',
            'delta_9' => '^9',
            'delta_10' => '^10',
            'delta_11' => '^11',
            'delta_12' => '^12',
            'all_delta' => '^',
            'res' => 'РЕС',
        ];

        // Формирование массива названий колонок
        $list='';  // Список полей для сброса в Excel
        $h=[];
        $i=0;
//        debug($model);
//        return;
        $j=0;
        $col_e=[];
        foreach($model[0] as $k=>$v){
            $col="'".$k."'";
            $col_e[$j]=$k;
            $j++;
            if(in_array(trim($k), array_keys($cols), true)){
                $h[$i]['col']=$col;
                $i++;
            }
        }

        $k1='Фактичні показання';
//        debug($col_e);
//        debug($cols);
//        return;

        $newQuery = clone $dataProvider->query;
        $models = $newQuery->all();

        \moonland\phpexcel\Excel::widget([
            'models' => $models,

            'mode' => 'export', //default value as 'export'
            'format' => 'Excel2007',
            'hap' => $k1,    //cтрока шапки таблицы
            'data_model' => 1,
            //'columns' => $h,
            'columns' => $col_e,
            'headers' => $cols
        ]);
        return;

    }

// Добавление новых пользователей
    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'buh1'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'buh1';
            $user->email = 'buh1@ukr.net';
            $user->setPassword('afynfpbz');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }

// Выход пользователя
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

//Щеденники

    public function actionA_diary_forma()
    {
        $model = new A_diary();
        $searchModel = new A_diary_search();
//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//        $model = $model::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//        debug('1111111111111');
            $sql = "SELECT date,txt,projects,status
FROM vw_diary 
where 1=1";
//            if (!empty($model->txt)) {
//                $sql2 = '(select txt from plan where id ='. $model->txt.')';
//                $model->txt = $sql2;
//                $sql = $sql . ' and txt =' . $model->txt  ;
//            }
//        debug($sql);
//        return;
            if (!empty($model->projects)) {
                $sql = $sql . ' and id_project =' . "'" . $model->projects . "'";
            }
//        debug($sql);
//        return;
            if (!empty($model->status)) {
                $sql = $sql . ' and id_status =' . "'" . $model->status . "'";
            }
//                debug($sql);
//        return;
//            if (!empty($model->year)) {
//                if ($model->year == '1')
//                    $model->year = '2018';
//                if ($model->year == '2')
//                    $model->year = '2019';
//                $sql = $sql . ' and year =' . "'" . $model->year . "'";
//            }
////                        debug($sql);
////        return;
            $sql = $sql . ' ORDER BY 3';
//            debug($sql);
//            return;
//            $data = Off_site::findbysql($sql)->asArray()
//                ->all();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//            debug($sql);
//            return;
            $dataProvider->pagination = false;
            return $this->render('a_diary_forma_2', [
                'model' => $searchModel,'dataProvider' => $dataProvider,'searchModel' => $searchModel,
            ]);
        } else {
            return $this->render('a_diary_forma', compact('model'));
        }
    }


    public function actionPlan_forma()
    {
        $model = new Plan_forma();
        $searchModel = new Plan();
//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//        $model = $model::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//        debug('1111111111111');
            $sql = "SELECT projects, plan_status, year, month, txt, speed
            FROM vw_plans 
            where 1=1";

            if (!empty($model->projects)) {
                $sql = $sql . ' and id_project =' . "'" . $model->projects . "'";
            }
//        debug($sql);
//        return;
            if (!empty($model->plan_status)) {
                $sql = $sql . ' and id_status =' . "'" . $model->plan_status . "'";
            }
//                debug($sql);
//        return;
            if (!empty($model->year)) {
                if ($model->year == '1')
                    $model->year = '2018';
                if ($model->year == '2')
                    $model->year = '2019';
                $sql = $sql . ' and year =' . "'" . $model->year . "'";
            }
//                        debug($sql);
//        return;
            if (!empty($model->month)) {
                $sql = $sql . ' and id_month =' . "'" . $model->month . "'";
            }
            if (!empty($model->txt)) {
                $sql2 = '(select txt from plan where id ='. $model->txt.')';
                $model->txt = $sql2;
                $sql = $sql . ' and txt =' . $model->txt  ;
            }
//        debug($sql);
//        return;
            if (!empty($model->speed)) {
                $sql2 = '(select speed from plan where id ='. $model->speed.')';
                $model->speed = $sql2;
                $sql = $sql . ' and speed =' . $model->speed;
            }
//        debug($sql);
//        return;
            $sql = $sql . ' ORDER BY 1';
//            debug($model);
//            return;
//            $data = Off_site::findbysql($sql)->asArray()
//                ->all();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//            debug($sql);
//            return;
            $dataProvider->pagination = false;
            return $this->render('plan_forma_2', [
                'model' => $searchModel,'dataProvider' => $dataProvider,'searchModel' => $searchModel,
            ]);
        } else {
            return $this->render('plan_forma', compact('model'));

        }
    }




    public function actionPhones_sap()
    {
        $model = new phones_sap();
        $searchModel = new phones_sap_search();
//    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//        $model = $model::find()->all();
//        Yii::$app->response->format = Response::FORMAT_JSON;
//        $c = mb_substr($fio,0,1,"UTF-8");
//        $code = ord($c);
//        if($code<128) $fio=recode_c(strtolower($fio));
//
//        $name1 = trim(mb_strtolower($fio,"UTF-8"));
//        $name2 = trim(mb_strtoupper($fio,"UTF-8"));
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//        debug('1111111111111');
            $sql = "SELECT *
FROM contacty_sap
where 1=1";
            if (!empty($model-> fio)) {
                $sql = $sql . " and fio like '" .$model->fio ."%'";
            }
//                debug($sql);
//        return;
            if (!empty($model-> company)) {
                if ($model->company == '1')
                    $model->company = '"Виконавець"';
                if ($model->company == '2')
                    $model->company = '"ВОЕ"';
                if ($model->company == '3')
                    $model->company = '"СОЕ"';
                if ($model->company == '4')
                    $model->company = '"ЦЕК"';
                if ($model->company == '5')
                    $model->company = '"ЧОЕ"';
                if ($model->company == '6')
                    $model->company = '"ЧОЕ (викл.?)"';
                $sql = $sql . " and company = " .$model->company;
            }
//                debug($sql);
//        return;
            $sql = $sql . ' ORDER BY 1';
//            debug($model);
//            return;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $sql);
//            debug($sql);
//            return;
            $dataProvider->pagination = false;
            return $this->render('phones_sap_2', [
                'model' => $searchModel,'dataProvider' => $dataProvider,'searchModel' => $searchModel,
            ]);
        } else {
            return $this->render('phones_sap', compact('model'));
        }
    }

    //    Страница о программе
    public function actionAbout()
    {
        $model = new info();
        $model->title = 'Про програму';
        $model->info1 = "Ця програма здійснює введення данних по фактичному споживанню электоенергії
         на підстанціях для власних потреб, а також формування звітів для порівняння споживання з нормативним споживанням.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('about', [
            'model' => $model]);
    }

}
