<?php
// Ввод основных данных для поиска телефонов

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$this->title = 'Власні потреби';
$arr = ['- Виберіть рік *-', '2020', '2019'];
$arr1 = ['- Виберіть РЕМ *-', 'СПС','Дніпропетровські РЕМ', 'Вільногірські РЕМ', 'Павлоградські РЕМ', 'Гвардійська дільниця',
    'Жовтоводські РЕМ', 'Криворізькі РЕМ','Апостолівська дільниця', 'Інгулецька дільниця','Запорізькі РЕМ'];
$arr2 = ['- Виберіть рівень напруги кВ *-', '6', '35', '150', '35 і 150'];

?>

<script>
     window.addEventListener('load', function(){
       $('#inputdata-id_t').each(function () {
        var txt = $(this).text()
        $(this).html(
            "<span style='color:#111111" + ";'></span>" + txt)
})
    }
    
</script>



<div class="site-login" <?php if(isset(Yii::$app->user->identity->role) && Yii::$app->user->identity->role==3) echo 'id="main_block"'; ?>>
    <h2><?= Html::encode('') ?></h2>
      <div class="row">
         
          <?php //debug(Yii::$app->user->identity); ?> 
          
        <div <?php if(isset(Yii::$app->user->identity->role) && Yii::$app->user->identity->role==3) echo 'class="col-lg-8"'; else echo 'class="col-lg-04 tel_left_side"'; ?>>
            <?php $form = ActiveForm::begin(['id' => 'inputdata',
                'options' => [
                    'class' => 'form-horizontal col-lg-25',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>
            <?= $form->field($model, 'year')-> textInput() -> dropDownList ( $arr )?>
<!--            --><?//= $form->field($model, 'voltage')-> textInput() -> dropDownList ( $arr2 )?>
            <?= $form->field($model, 'rem')-> textInput() -> dropDownList ( $arr1 )?>
            <?= $form->field($model, 'up')->checkbox(['checked'=>false]) ?>

            <?= Html::submitButton('OK',['class' => 'btn btn-success']) ?>
            <br>

            <?php ActiveForm::end(); ?>
        </div>
          

    </div>
</div>


<script>
    function dsave()
    {

        localStorage.setItem("fio",$('#inputdata-fio').val());
    }
    function sel_fio(elem,id) {
        //localStorage.setItem("id_fio", id);
        var p,r;
        elem=$.trim(elem);
        //alert(elem+'1');
        p=elem.indexOf('  ')+1;
        r=elem.substr(0,p);
        r=$.trim(r);
       
        if(p>0)
            $("#inputdata-fio").val(r);
        else
            $("#inputdata-fio").val(elem);
        
        $(".field-inputdata-id_t").hide();
        $("#inputdata-id_t").hide();
        //$("#klient-search_street").val('');
        
    }
     function sel_fio1(elem,event) {
        //alert(event.keyCode);
        if(event.keyCode==13) {
            $("#inputdata-fio").val(elem);
            $("#inputdata-id_t").hide();
        }
    }
    
     function normtel(p){
        if(p==null) return '';
        //if(!(p.indexOf(',')==-1)) return '';
        var pos = p.indexOf(',');
        var qt,jt,frez='',origin;
        origin=p;
        if (pos==-1)
            qt=1;
        else
            qt=2;
        if(qt==2)
            $("#inputdata-id_t").css("font-size", 13);
        else
            $("#inputdata-id_t").css("font-size", 14);
        for(jt=1;jt<=qt;jt++) {
        if (pos>-1 && jt==1)
            p=origin.substr(0,pos); 
        if (pos>-1 && jt==2)
            p=origin.substr(pos+1);
        //alert(p);
        if(!(p.substr(0,1)=='0'))
            p='0'+p; 
        var y,i,c,tel = '',kod,op,flag=0,rez='';
        y = p.length;

        for(i=0;i<y;i++)
        {
            c = p.substr(i,1);
            kod=p.charCodeAt(i);
            if(kod>47 && kod<58) tel+=c;
        }
        op = tel.substr(0,3);
        y = tel.length;
        if(y<10) {
            return '';
        }
            switch(op) {
                case '050':  flag = 1;
                    break;
                case '096':  flag = 1;
                    break;
                case '097':  flag = 1;
                    break;
                case '098':  flag = 1;
                    break;
                case '099':  flag = 1;
                    break;

                case '091':  flag = 1;
                    break;
                case '063':  flag = 1;
                    break;
                case '073':  flag = 1;
                    break;
                case '067':  flag = 1;
                    break;
                case '066':  flag = 1;
                    break;

                case '093':  flag = 1;
                    break;
                case '095':  flag = 1;
                    break;
                case '039':  flag = 1;
                    break;
                case '068':  flag = 1;
                    break;
                case '092':  flag = 1;
                    break;
                case '094':  flag = 1;
                    break;
            }

            var add = tel.substr(3,3);
            rez+=add+'-';
            add = tel.substr(6,2);
            rez+=add+'-';
            add = tel.substr(8);
            rez+=add;

        if(flag) {
            rez = op+' '+rez;
        }
        else{
            rez = '('+op+')'+' '+rez;
        }
            
            if(qt==2 && jt==1)
                frez=rez+', ';
            if(qt==2 && jt==2)
                frez+=rez;
             if(qt==1)
                frez=rez;
        }
        return frez;
    }

function stringFill(x, n) { 
    var s = ''; 
    while (s.length < n) s += x; 
    return s; 
} 


    //window.onload=function(){
   
</script>





