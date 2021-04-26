<?php
/* Ввод основных данных  */

namespace app\models;

use Yii;
use yii\base\Model;

class DataReport extends Model
{
    public $year;        // Год
    public $month;     // Месяц
    public $sql;


    public function attributeLabels()
    {
        return [
            'year' => 'Рік:',
            'month' => 'Місяць:',
        ];
    }

    public function rules()
    {
        return [
            ['year', 'safe'],
            ['month', 'safe'],
            ['sql', 'safe'],
        ];
    }
}
