<?php

use app\modules\license\models\Receive;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <div style="padding-left: 275px;">
            <strong style="font-size:16pt;">แบบคำขอแจ้ง </strong>              
        </div><p>
        <div style="padding-left: 150px; font-size:15pt;">จัดตั้งสถานที่จำหน่ายอาหารหรือสถานที่สะสมอาหาร</div>
        <p><p>
        <div style="padding-left: 450px; font-size:15pt;">เขียนที่...............................................</div>
        <div style="padding-left: 450px; font-size:15pt;">วันที่...................................................</div>
        <p><p>
        <div style="padding-left: 30px; font-size:15pt;">
            1. ข้าพเจ้า............................................................................................อายุ............ปี สัญชาติ............................................                
        </div>
        <div style="font-size:15pt;">
            โดย........................................................................................................................ผู้มีอำนาจลงนามแทนนิติบุคคลปรากฎตาม               
        </div>
        <div style="font-size:15pt;">
            .............................................................................ที่อยู่เลขที่.................................................................หมู่ที่................................              
        </div>
        <div style="font-size:15pt;">
            ตรอก/ซอย........................................ถนน.....................แขวง/ตำบล............................เขต/อำเภอ.............................................        
        </div>
        <div style="font-size:15pt;">
            จังหวัด............................................หมายเลขโทรศัพท์..............................................ผู้ขอแจ้ง              
        </div>
        <div style="padding-left: 30px; font-size:15pt;">
            2. ชื่อสถานประกอบกิจการ...................................................ประเภท..................................มีพื้นที่.................ตารางเมตร             
        </div>
        <div style="font-size:15pt;">
            ตั้งอยู่เลขที่...........................หมู่ที่..................ตำบล............................อำเภอ......................................จังหวัด..............................        
        </div>
        <div style="font-size:15pt;">
           หมายเลขโทรศัพท์......................................................          
        </div>
        <div style="padding-left: 30px; font-size:15pt;">
            3. พร้อมคำขอนี้ข้าพเจ้าได้แนบเอกสารหลักฐานต่างๆ มาด้วยแล้วดังนี้            
        </div>
        <div style="padding-left: 40px; font-size:15pt;">
            __ สำเนาบัตรประจำตัว(ประชาชน/ข้าราชการ/พนักงานรัฐวิสาหกิจ/อื่นๆ ระบุ..................)           
        </div>
        <div style="font-size:15pt;">
            ของผู้แทนนิติบุคคลและผู้รับมอบอำนาจ(ถ้ามี)       
        </div>
        <div style="padding-left: 40px; font-size:15pt;">
            __ สำเนาบัตรใบอนุญาตตามกฎหมายที่เกี่ยวข้องได้แก่.............................        
        </div>
       <div style="font-size:15pt;">
            ....................................................................................................................................................................................................    
        </div>
        <div style="padding-left: 40px; font-size:15pt;">
            __ หลักฐานที่แสดงการเป็นผู้มีอำนาจลงนามแทนนิติบุคคลและใบมอบอำนาจ(ในกรณีที่มีการมอบอำนาจ)        
        </div>
        <div style="padding-left: 40px; font-size:15pt;">
            __ สำเนาหนังสือรับรองการจดทะเบียนเป็นนิติบุคคล      
        </div>
        <div style="padding-left: 40px; font-size:15pt;">
            __ เอกสารหลักฐานอื่นๆตามที่ราชการส่วนท้องถิ่นประกาศกำหนดได้แก่.....................................................................   
        </div>
        <div style="font-size:15pt;">
            ....................................................................................................................................................................................................    
        </div>
        <p><p><p><p>
        <div style="padding-left: 20px; font-size:15pt;">
            ขอรับรองว่าข้อความในคำขอนี้เป็นความจริงทุกประการ     
        </div>
        <p><p><p><p>

        <div style="padding-left: 300px;  font-size:15pt;">
            (ลงชื่อ)................................................ผู้ขอแจ้ง<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            (................................................)<br>

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
