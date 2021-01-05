<?php
/* Ввод основных данных  */

namespace app\models;

use Yii;
use yii\base\Model;

class Norms extends Model
{
    public $id;
    public $nazv;
    public $rem;
    public $voltage;
    public $mon_1;
    public $mon_2;
    public $mon_3;
    public $mon_4;
    public $mon_5;
    public $mon_6;
    public $mon_7;
    public $mon_8;
    public $mon_9;
    public $mon_10;
    public $mon_11;
    public $mon_12;
    public $year;



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
            'year' => 'Рік'
        ];
    }

    public function rules()
    {
        return [
            ['nazv', 'safe'],
            ['rem', 'safe'],
            ['voltage', 'safe'],
            ['mon_1', 'safe'],
            ['mon_2', 'safe'],
            ['mon_3', 'safe'],
            ['mon_4', 'safe'],
            ['mon_5', 'safe'],
            ['mon_6', 'safe'],
            ['mon_7', 'safe'],
            ['mon_8', 'safe'],
            ['mon_9', 'safe'],
            ['mon_10', 'safe'],
            ['mon_11', 'safe'],
            ['mon_12', 'safe'],
            ['year', 'safe']
        ];
    }
}
