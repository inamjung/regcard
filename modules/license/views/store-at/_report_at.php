<?php

use yii\helpers\Url;
use app\modules\license\models\StoreAt;
use dixonsatit\thaiYearFormatter\ThaiYearFormatter;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyType;
use app\modules\license\models\Regconfig;
use app\modules\license\models\Thaiaddress;

$regc = Regconfig::find()->one();
$add = Thaiaddress::find()->where(['addressid'=>$regc->addressid])->one();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <img src="img/krug.png"  width="60" height="60" >
        <div style="padding-left: 275px;">
            <strong style="font-size:16pt;">บันทึกข้อความ </strong>              
        </div>
        <div style="font-size:15pt;"><strong>ส่วนราชการ</strong>&nbsp;&nbsp;&nbsp; <?= $model->place_request; ?><?= $add->name; ?>&nbsp;&nbsp;<?= $add->full_name; ?>&nbsp;&nbsp;&nbsp;โทร&nbsp;&nbsp;<?= thainumDigit($regc->tel); ?></div>        
        <div style="font-size:15pt;">
            <strong>ที่</strong>&nbsp;&nbsp;&nbsp;<?= thainumDigit($regc->book_no); ?>&nbsp;........................วันที่&nbsp;&nbsp;&nbsp;<?= thainumDigit(DateThaiLong($model->date_survey)); ?><p>                  
        </div>
        <div style="font-size:15pt;">
            <strong> เรื่อง</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายงานผลการตรวจสภาพสถานที่ประกอบกิจการเพื่อประกอบการพิจารณาการอนุญาต
        </div>
        <div style=" font-size:15pt;">
            <strong> เรียน</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าพนักงานท้องถิ่น
        </div><p>
        <div style="padding-left: 50px; font-size:15pt;">
            ตามที่ราชการส่วนท้องถิ่นได้รับคำขอรับใบอนุญาตประกอบกิจการ &nbsp;&nbsp;&nbsp; <?= $model->store_name; ?>
        </div>
        <div style="font-size:15pt;">
            และได้ออกใบรับคำขออนุญาตเลขที่ &nbsp;&nbsp;&nbsp; <?= thainumDigit($model->code_no); ?>&nbsp;&nbsp;&nbsp; ลงวันที่&nbsp;&nbsp;&nbsp;  <?= thainumDigit(DateThaiLong($model->date_request)); ?>

        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            จากการตรวจสภาพด้านสุขลักษณะของสถานที่เครื่องมืออุปกรณ์ระบบบำบัดหรือกำจัดของเสีย และด้านต่างๆ          
        </div>
        <div style="font-size:15pt;">
            ของสถานที่ประกอบกิจการดังกล่าวแล้วพบว่า&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
            <strong>
            <?php
                if ($model->survey_type == '1') {
                   echo '<li style="color: green" class="glyphicon glyphicon-ok-circle"></li> ครบถ้วนถูกต้องตามข้อกำหนดไว้ในข้อกำหนดของท้องถิ่น';
                } elseif ($model->survey_type == '2') {
                    echo "<span class='glyphicon glyphicon-ok'> ไม่ครบ คือ";
                } else {
                   echo '';
                }
                ;
            ?></strong>
        </div>
        <div style="padding-left: 80px; font-size:15pt;">
            
            <table style="font-size:15pt;">
        
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (SurveyDetailType::find()->where(['store_at_id' => $model->receive_id])->orderBy('id')->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->typename->name;?></td>                               
                                
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table>        
            
        </div>


        <div style="padding-left: 50px; font-size:15pt;">
            <?php if ($model->survey_text == '1') {
                echo ' ฉะนั้น  จึงมีความเห็นว่า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>ไม่สมควรอนุญาต</b>';
            } elseif ($model->survey_text == '2') {
                echo ' ฉะนั้น  จึงมีความเห็นว่า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>สมควรอนุญาต</b>';
            } elseif ($model->survey_text == '3') {
                echo ' ฉะนั้น  จึงมีความเห็นว่า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>สมควรอนุญาตโดยมีเงื่อนไข ดังนี้</b>';
            } else {
                echo '';
            }
            ;?>
        </div>
        <div style="padding-left: 200px; font-size:15pt;">
            <?php
            $aa= StoreAt::find()->where(['id' => $model->id])->one();
            $bb = SurveyDetailText::find()->where(['store_at_id' => $model->id])->all();            
            ?>
            <table> 

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bb as $datas): ?>
                        <tr>
                            <td style="width: 25px; font-size:15pt;"><?= $i++ . ')'; ?></td>
                            <td style="width: 150px; font-size:15pt;"><?= $datas->name; ?></td>                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
        <p><p><p>
        <div style="padding-left: 50px; font-size:15pt;">
            จึงเรียนมาเพื่อโปรดพิจารณา          
        </div>
        <p><p><p>

        <div style="padding-left: 300px;  font-size:15pt;">
            (ลงชื่อ)................................................<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(
                    <?php if($model->user_survey !=''){
                        echo $model->atuser->name;
                    } else {
                        echo '';
                    }?>)<br>
                ตำแหน่ง &nbsp;&nbsp;<?php if($model->user_survey !=''){
                        echo $model->atuser->positionname->name;
                    } else {
                        echo '';
                    }?>
        </div>
        <div style="padding-left: 200px;  font-size:15pt;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            เจ้าพนักงานสาธารณสุข/ผู้ที่ได้รับแต่งตั้งจากเจ้าพนักงานท้องถิ่น
        </div>                
    </div> 
    <p><p><p><p>


</body>
</html>

<?php //echo convert($model->money+$model->money1+$model->money2+$model->money3+$model->money4) ; ?>

<?php

function DateThai($strDate) {
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    //$strYear=substr($strYear,2,2);
    return "$strDay $strMonthThai $strYear";
}

// echo DateThai(date('Y-m-d'));
?>

<?php

function DateThaiLong($strDate) {
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    //$strYear=substr($strYear,2,2);
    return "$strDay $strMonthThai $strYear";
}

// echo DateThai(date('Y-m-d'));
?>

<?php

function thainumDigit($num) {
    return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}

;
?>
<?php

function convert($number) {
    $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $number = str_replace(",", "", $number);
    $number = str_replace(" ", "", $number);
    $number = str_replace("บาท", "", $number);
    $number = explode(".", $number);
    if (sizeof($number) > 2) {
        return 'ทศนิยมหลายตัวนะจ๊ะ';
        exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for ($i = 0; $i < $strlen; $i++) {
        $n = substr($number[0], $i, 1);
        if ($n != 0) {
            if ($i == ($strlen - 1) AND $n == 1) {
                $convert .= 'เอ็ด';
            } elseif ($i == ($strlen - 2) AND $n == 2) {
                $convert .= 'ยี่';
            } elseif ($i == ($strlen - 2) AND $n == 1) {
                $convert .= '';
            } else {
                $convert .= $txtnum1[$n];
            }
            $convert .= $txtnum2[$strlen - $i - 1];
        }
    }

    $convert .= 'บาท';
    if ($number[1] == '0' OR $number[1] == '00' OR
            $number[1] == '') {
        $convert .= 'ถ้วน';
    } else {
        $strlen = strlen($number[1]);
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[1], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) AND $n == 1) {
                    $convert .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) AND
                        $n == 2) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) AND
                        $n == 1) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }
        $convert .= 'สตางค์';
    }
    return $convert;
}
