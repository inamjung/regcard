<?php

use app\modules\license\models\ReceiveFinal;
use yii\helpers\Url;
use app\modules\license\models\SurveyDetailText;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <img src="img/krug.png"  width="90" height="90" style="padding-left:260px;" >
        <div style="padding-left: 275px;">
            <strong style="font-size:16pt;">ใบอนุญาต </strong>              
        </div><p>
        <div style="padding-left: 150px; font-size:15pt;">ประเภทกิจการ &nbsp;&nbsp;&nbsp; <?= $model->storetypefinal->name; ?></div>
        <p><p>
        <div style="font-size:15pt;">
            เล่มที่............เลขที่............/..............<br><p><p>                  
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (1) เจ้าพนักงานท้องถิ่นอนุญาตให้&nbsp;&nbsp;&nbsp;<?= $model->store_own_pname.$model->store_own_fname.'  '.$model->store_own_lname; ?>&nbsp;&nbsp;&nbsp;สัญชาติ&nbsp;&nbsp;&nbsp;<?= $model->nation->name; ?>
        </div>
        <div style=" font-size:15pt;">
            อยู่บ้านเลขที่&nbsp;&nbsp;&nbsp; <?= $model->store_own_addr;?>
            หมายเลขโทรศัพท์&nbsp;&nbsp;&nbsp; <?= $model->store_phone;?>
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            ชื่อสถานประกอบการ&nbsp;&nbsp;&nbsp; <?= $model->store_name; ?>&nbsp;&nbsp;&nbsp;ประเภท&nbsp;&nbsp;&nbsp; <?= $model->storetypefinal->name; ?>
        </div>
        <div style="font-size:15pt;">
            ตั้งอยู่เลขที่&nbsp;&nbsp;&nbsp; <?= $model->store_addr;?>&nbsp;&nbsp;&nbsp;
            โทรศัพท์&nbsp;&nbsp;&nbsp; <?= $model->store_phone;?>
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            เสียค่าธรรมเนียมปีละ&nbsp;&nbsp;&nbsp; 
            <?php if($model->service_fee != ''){
                echo thainumDigit($model->service_fee);
            } else {
                echo '';
            } ;?> 
            &nbsp;&nbsp;บาท &nbsp;&nbsp;( <?php if($model->service_fee != ''){
                echo convert($model->service_fee);
            } else {
                echo '';
            } ;?> )
        </div>
        <div style="font-size:15pt;">
            ตามใบเสร็จรับเงินเล่มที่&nbsp;&nbsp;&nbsp;<?= $model->bill_book;?>&nbsp;&nbsp;&nbsp;ลงวันที่&nbsp;&nbsp;&nbsp;<?php if($model->bill_date != ''){
                echo thainumDigit(DateThaiLong($model->bill_date));
            } else {
                echo '';
            } ;?>
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (2) ผู้รับใบอนุญาตต้องปฏิบัติตามหลักเกณฑ์ วิธีการแจ้งและเงื่อนไขที่กำหนดในข้อกำหนดของท้องถิ่น
        </div>
        
        <div style="padding-left: 50px; font-size:15pt;">
            (3) หากปรากฎในภายหลังว่าการประกอบกิจการที่ได้รับอนุญาตนี้เป็นการขัดต่อกฎหมายอื่นที่เกี่ยวข้อง
        </div>
        <div style="font-size:15pt;">
           โดยมิอาจแก้ไขได้ เจ้าพนักงานท้องถิ่นอาจพิจารณาให้เพิกถอนการอนุญาตนี้ได้
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (4) ผู้รับใบอนุญาตต้องปฏิบัติตามเงื่อนไขเฉพาะดังต่อไปนี้ คือ
        </div>
        <div style="padding-left: 60px; font-size:15pt;">
      <?php            
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
        <div style="padding-left: 50px; font-size:15pt;">
            (5) ใบอนุญาตฉบับนี้ออกให้เมื่อวันที่&nbsp;&nbsp;&nbsp;<?php if($model->final_date_start != ''){
                echo thainumDigit(DateThaiLong($model->final_date_start));
            } else {
                echo '';
            } ;?>         
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (6) ใบอนุญาตฉบับนี้สิ้นอายุเมื่อวันที่&nbsp;&nbsp;&nbsp;<?php if($model->final_date_exp != ''){
                echo thainumDigit(DateThaiLong($model->final_date_exp));
            } else {
                echo '';
            } ;?>            
        </div>
        <p><p>
            
        <div style="padding-left: 300px;  font-size:15pt;">
            (ลงชื่อ)................................................<br>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?= $model->confirmname->name;?>)<br/>
                ตำแหน่ง &nbsp;&nbsp;<?= $model->confirmname->positionname->name;?><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าพนักงานท้องถิ่น
        </div>                
    </div> 
    <p><p><p><p>

    <div style="font-size:14pt;">
        คำเตือน (1) ผู้รับใบอนุญาตนี้ต้องแสดงใบอนุญาตนี้ไว้โดยเปิดเผยและเห็นได้ง่าย ณ สถานที่ประกอบกิจการตลอดเวลา
    </div>
    <div style="font-size:14pt;">
        ที่ประกอบกิจการ หากฝ่าฝืนมีโทษปรับไม่เกิน 500 บาท
    </div>
    <div style="padding-left: 45px; font-size:14pt;">
        (2) หากประสงค์จะประกอบกิจการในปีต่อไปต้องยื่นคำขอต่ออายุใบอนุญาตก่อนใบอนุญาตสิ้นอายุ         
    </div>
    

</body>
</html>

<?php //echo convert($model->money+$model->money1+$model->money2+$model->money3+$model->money4) ;?>

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
