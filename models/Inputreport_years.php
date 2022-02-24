<?php
/* Ввод основных данных  */

namespace app\models;

use Yii;
use yii\base\Model;

class Inputreportr_years extends Model
{
    public $year1;        // Год
    public $year2;        // Год
    public $year3;        // Год
    public $year4;        // Год

    public function attributeLabels()
    {
        return [
            'year1' => 'Рік 2019:',
            'year2' => 'Рік 2020:',
            'year3' => 'Рік 2021:',
            'year4' => 'Рік 2022:',
        ];
    }

    public function rules()
    {
        return [
            ['year1', 'safe'],
            ['year2', 'safe'],
            ['year3', 'safe'],
            ['year4', 'safe'],
        ];
    }
}
