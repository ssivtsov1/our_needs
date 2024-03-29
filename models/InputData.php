<?php
/* Ввод основных данных  */

namespace app\models;

use Yii;
use yii\base\Model;

class InputData extends Model
{
    public $id;
    public $year;        // Год
    public $voltage;     // Уровень напряжения
    public $rem;           // РЭС
    private $_user;
    public $up;

    public function attributeLabels()
    {
        return [
            'year' => 'Рік:',
            'voltage' => 'Рівень напруги:',
            'rem' => 'РЕМ:',
            'up' => 'Споживання більше норми',
        ];
    }

    public function rules()
    {
        return [
            ['year', 'safe'],
            ['voltage', 'safe'],
            ['rem', 'safe'],
            ['up', 'safe'],
        ];
    }
}
