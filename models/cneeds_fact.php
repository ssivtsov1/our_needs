<?php
/**
 * Используется для просмотра сотрудников
 */
namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

class cneeds_fact extends \yii\db\ActiveRecord
{
    public $delta_1;
    public $delta_2;
    public $delta_3;
    public $delta_4;
    public $delta_5;
    public $delta_6;
    public $delta_7;
    public $delta_8;
    public $delta_9;
    public $delta_10;
    public $delta_11;
    public $delta_12;
    public $res;
    public $all_month;
    public $all_delta;
    public $pointer;
    public $rid;

    public static function tableName()
    {
        return 'needs_fact';
    }

    public function attributeLabels()
    {
        return [
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
            'all_month' => 'Усього',
            'voltage' => 'U, кВ',
            'res' => 'РЕМ',
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
            'year' => 'Рік',
            'pointer' => '*',
        ];
    }

    public function rules()
    {
        return [

            [['id','month_1','month_2','month_3','month_4','month_5','month_6','month_7','month_8','pointer',
                'month_9','month_10','month_11','month_12','voltage','nazv','delta_1','delta_2','res','year','rid'
              ],'safe']
            ];
    }

    public function search($params,$sql)
    {
        $query = needs_fact::findBySql($sql);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function getDb()
    {
            return Yii::$app->get('db');
    }

}


