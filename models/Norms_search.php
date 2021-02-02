<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

class Norms_search extends \yii\db\ActiveRecord
{
    public $sum_potr;

    public static function tableName()
    {
        return 'needs_norm';
    }

    public function attributeLabels()
    {
        return [
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
            'year' => 'Рік',
            'sum_potr' => 'Всього:'
        ];
    }

    public function search($params, $sql)
    {
        $query = Norms_search::findBySql($sql);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // $query->andFilterWhere([
        //    'work' => $this->work,
        // ]);

//        $query->andFilterWhere(['like', 'work', $this->work]);
//        $query->andFilterWhere(['like', 'usluga', $this->usluga]);
//        $query->andFilterWhere(['=', 'stavka_grn', $this->stavka_grn]);
//        $query->andFilterWhere(['=', 'time_transp', $this->time_transp]);
//        $query->andFilterWhere(['=', 'type_transp', $this->type_transp]);
//        $query->andFilterWhere(['like', 'brig', $this->brig]);
//        $query->andFilterWhere(['=', 'cast_1', $this->cast_1]);
//        $query->andFilterWhere(['=', 'cast_2', $this->cast_2]);
//        $query->andFilterWhere(['=', 'cast_3', $this->cast_3]);
//        $query->andFilterWhere(['=', 'cast_4', $this->cast_4]);
//        $query->andFilterWhere(['=', 'cast_5', $this->cast_5]);
//        $query->andFilterWhere(['=', 'cast_6', $this->cast_6]);

        return $dataProvider;
    }

    public static function getDb()
    {
        return Yii::$app->get('db');
    }
}