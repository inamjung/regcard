<?php

use app\modules\license\models\Receive;
use yii\helpers\Url;
use app\modules\license\models\SurveyDetailText;
use app\modules\license\models\SurveyDetailType;
use app\modules\license\models\SurveyType;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <img src="img/krug.png"  width="90" height="90" style="padding-left:260px;" >
        <div style="padding-left: 250px;">
            <strong style="font-size:15pt;">หนังสือรับรองการแจ้ง </strong>              
        </div>
        <div style="padding-left: 185px; font-size:15pt;">จัดตั้งสถานที่จำหน่ายอาหารหรือสะสมอาหาร</div>
        <p><p>
        <div style="font-size:15pt;">
            เล่มที่............เลขที่............/..............<br><p><p>                  
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (1) เจ้าพนักงานท้องถิ่นออกหนังสือรับรองการแจ้งให้&nbsp;&nbsp;&nbsp;<?= $model->store_own_pname.$model->store_own_fname.'  '.$model->store_own_lname; ?>
        </div>
        <div style=" font-size:15pt;">
            สัญชาติ&nbsp;&nbsp;&nbsp;<?= $model->nation->name; ?>&nbsp;&nbsp;&nbsp;อยู่บ้านเลขที่&nbsp;&nbsp;&nbsp; <?= $model->store_addr;?><br>
            หมายเลขโทรศัพท์&nbsp;&nbsp;&nbsp; <?= $model->store_phone;?>
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            ชื่อสถานประกอบการ&nbsp;&nbsp;&nbsp; <?= $model->store_name; ?>&nbsp;&nbsp;&nbsp;ประเภท&nbsp;&nbsp;&nbsp; <?= $model->storetype->name; ?>มีพื้นที่&nbsp;&nbsp;&nbsp; <?= $model->store_area;?>&nbsp;&nbsp;&nbsp; ตารางเมตร
        </div>
        <div style="font-size:15pt;">
            ตั้งอยู่เลขที่&nbsp;&nbsp;&nbsp; <?= $model->store_addr;?>&nbsp;&nbsp;&nbsp;โทรศัพท์&nbsp;&nbsp;&nbsp; <?= $model->store_phone;?>
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            เสียค่าธรรมเนียมปีละ.................บาท(................................)
        </div>
        <div style="font-size:15pt;">
            ตามใบเสร็จรับเงินเล่มที่...............เลขที่.................ลงวันที่...........
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (2) ผู้รับหนังสือรับรองการแจ้งต้องปฏิบัติตามหลักเกณฑ์ วิธีการแจ้งและเงื่อนไขที่กำหนดในข้อกำหนดของท้องถิ่น
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (3) ผู้รับใบอนุญาตต้องปฏิบัติตามเงื่อนไขเฉพาะดังต่อไปนี้อีกด้วย  คือ
        </div>
        <div style="padding-left: 60px; font-size:15pt;">
            (3.1) .....................................................................................................................<br>
            (3.2) .....................................................................................................................
        </div>
        <div style="padding-left: 50px; font-size:15pt;">
            (4) หนังสือรับรองการแจ้งฉบับนี้ออกให้เมื่อวันที่.....................................................
            <br>
        </div><p><p>
        <div style="padding-left: 300px;  font-size:15pt;">
            (ลงชื่อ)................................................<br>
            (.....................................................)<br>
            ตำแหน่ง..............................................<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าพนักงานท้องถิ่น
        </div>                
    </div> 
    <p><p><p><p>

    <div style="font-size:14pt;">
        คำเตือน (1) ผู้รับหนังสือรับรองการแจ้งต้องแสดงหนังสือรับรองการแจ้งนี้ไว้โดยเปิดเผยและเห็นได้ง่าย
    </div>
    <div style="font-size:14pt;">
        ณ สถานที่ประกอบกิจการตลอดเวลาที่ประกอบกิจการ หากฝ่าฝืนมีโทษปรับไม่เกิน 500 บาท
    </div>
    <div style="padding-left: 45px; font-size:14pt;">
        (2) ผู้รับหนังสือรับรองการแจ้งต้องเสียค่าธรรมเนียมต่อราชการส่วนท้องถิ่นทุกปีตามกำหนดเวลา หากฝ่าฝืน          
    </div>
    <div style="font-size:14pt;">
        ต้องเสียค่าปรับเพิ่มอีกร้อยละยี่สิบของค่าธรรมเนียมที่ค้างชำระ
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
