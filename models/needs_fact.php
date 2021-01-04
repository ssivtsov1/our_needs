<?php
/**
 * Используется для просмотра сотрудников
 */
namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

class needs_fact extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'needs_fact'; //Это вид
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
            'voltage' => 'Рівень напруги',
        ];
    }

    public function rules()
    {
        return [

            [['id','month_1','month_2','month_3','month_4','month_5','month_6','month_7','month_8',
                'month_9','month_10','month_11','month_12','voltage','nazv'
              ],'safe']
            ];
    }

    public function search($params)
    {
        
        $query = needs_fact::find();
//        $tel_mob = trim($this->tel_mob); 
//        if(substr($tel_mob,0,1)=='0') $tel_mob = substr($tel_mob,1);
//        $tel_mob = only_digit($tel_mob);
       
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $tel = trim($this->tel_mob);
        $query->andFilterWhere(['=', 'tab_nom', $this->tab_nom]);
        $query->andFilterWhere(['like', 'fio', $this->fio]);
        $query->andFilterWhere(['like', 'post', $this->post]);
        if(substr($tel,0,1)=='0' &&  strlen($tel)>1){
            $fnd = '%'.substr($tel,1).'%';
            $query->andFilterWhere(['like', 'tel_mob', $fnd, false]);}
        else
            $query->andFilterWhere(['like', 'tel_mob', only_digit($this->tel_mob)]);

        $query->andFilterWhere(['like', 'tel', $this->tel]);
        $query->andFilterWhere(['like', 'tel_town', only_digit($this->tel_town)]);
        $query->andFilterWhere(['like', 'main_unit', $this->main_unit]);
        $query->andFilterWhere(['like', 'unit_1', $this->unit_1]);
        $query->andFilterWhere(['like', 'unit_2', $this->unit_2]);
        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['like', 'email_group', $this->email_group]);

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


