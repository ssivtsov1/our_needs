<?php
/* Ввод основных данных  */

namespace app\models;

use Yii;
use yii\base\Model;

class DataReport extends Model
{
    public $id;
    public $year;        // Год
    public $month;     // Месяц

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

        ];
    }
}
