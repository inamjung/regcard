<?php

use app\modules\license\models\Receive;
use app\modules\license\models\ReceiveDetailEvidenceNot;
use app\modules\license\models\Evidence;
use app\modules\license\models\ReceiveDetailEvidence;
use app\models\Users;
use app\models\Positions; 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <div style="padding-left: 240px;">
            <strong style="font-size:18pt;">ส่วนของเจ้าหน้าที่ </strong>
        </div><p><p>
        <div style="font-size:15pt;">
            <strong>ใบรับคำขอรับใบอนุญาต/ต่ออายุใบอนุญาต</strong><br><p><p>                  
                เลขที่&nbsp;&nbsp;&nbsp; <?= $model->code_no; ?>
                ได้รับเรื่องเมื่อวันที่&nbsp;&nbsp;&nbsp; <?= thainumDigit(DateThaiLong($model->date_request)); ?>
                <br>      
                ตรวจสอบแล้ว  เอกสารหลักฐาน  &nbsp;&nbsp;&nbsp; 
                <strong><?php
                if ($model->evidence_complete == '1') {
                    echo 'ครบ';
                } elseif ($model->evidence_complete == '2') {
                    echo 'ไม่ครบ คือ';
                } else {
                    echo '';
                };
                ?>
                </strong>    
                <br>
            <div style="padding-left: 168px;"><table style="font-size:15pt;">        
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->id])->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->evidencenamenot->evidence;?></td>                               
                                
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table>   
            </div><p><p>
            <div style="padding-left: 300px;">
                (ลงชื่อ)................................................<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?= $model->servicename->name;?>)<br>
                ตำแหน่ง &nbsp;&nbsp;<?= $model->servicename->positionname->name;?>
            </div>                
        </div> 
        <p><p>

        <hr>
        <div style="padding-left: 240px;">
            <strong style="font-size:18pt;">ส่วนของผู้ขอรับใบอนุญาต </strong>
        </div><p><p>
        <div style="font-size:15pt;">
            <strong>ใบรับคำขอรับใบอนุญาต/ต่ออายุใบอนุญาต</strong><br><p><p>                           
                เลขที่&nbsp;&nbsp;&nbsp; <?= $model->code_no; ?>
                ได้รับเรื่องเมื่อวันที่&nbsp;&nbsp;&nbsp; <?= thainumDigit(DateThaiLong($model->date_request)); ?>
                <br>      
                ตรวจสอบแล้ว  เอกสารหลักฐาน  &nbsp;&nbsp;&nbsp; 
               <strong><?php
                if ($model->evidence_complete == '1') {
                    echo 'ครบ';
                } elseif ($model->evidence_complete == '2') {
                    echo 'ไม่ครบ คือ';
                } else {
                    echo '';
                };
                ?>
               </strong>
                <br>
            <div style="padding-left: 168px;"><table style="font-size:15pt;">        
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->id])->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->evidencenamenot->evidence;?></td>                               
                                
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table> 
            </div>
            ดังนั้น  กรุณานำเอกสารหลักฐานที่ยังไม่ครบทั้งหมดมายื่นต่อเจ้าพนักงานท้องถิ่นภายใน..........วันนับตั้งแต่วันนี้เป็นต้นไป
            <p><p>
            <div style="padding-left: 300px;">
                (ลงชื่อ)................................................<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?= $model->servicename->name;?>)<br>
                ตำแหน่ง &nbsp;&nbsp;<?= $model->servicename->positionname->name;?>
            </div>
        </div>     



<!--<pagebreak />        -->
    <pagebreak />

    <div style="padding-left: 240px;">
        <strong style="font-size:18pt;">ส่วนของเจ้าหน้าที่ </strong>
    </div><p><p>
    <div style="font-size:15pt;">
        <strong>ใบรับแจ้ง</strong>
    </div><p><p>  
    <div style="font-size: 15pt;">
        ชื่อสถานประกอบกิจการ&nbsp;&nbsp;&nbsp; <?= $model->store_name; ?>
        ประเภท&nbsp;&nbsp;&nbsp; <?= $model->storetype->name; ?>&nbsp;&nbsp;&nbsp;มีพื้นที่&nbsp;&nbsp;&nbsp; <?= $model->store_area; ?>&nbsp;&nbsp;&nbsp;ตารางเมตร
        <br>   
        ตั้งอยู่เลขที่&nbsp;&nbsp;&nbsp; <?= $model->store_addr; ?>&nbsp;&nbsp;&nbsp;หมายเลขโทรศัพท์&nbsp;&nbsp;&nbsp; <?= $model->store_phone; ?><br>                
        เลขที่&nbsp;&nbsp;&nbsp; <?= $model->code_no; ?>&nbsp;&nbsp;&nbsp;ได้รับเรื่องเมื่อวันที่&nbsp;&nbsp;&nbsp; <?= thainumDigit(DateThaiLong($model->date_request)); ?>
        <br>                
        ตรวจสอบแล้ว  เอกสารหลักฐาน  &nbsp;&nbsp;&nbsp; 
        <strong><?php
                if ($model->evidence_complete == '1') {
                    echo 'ครบ';
                } elseif ($model->evidence_complete == '2') {
                    echo 'ไม่ครบ คือ';
                } else {
                    echo '';
                };
                ?>
                </strong>                

    </div>

    <div style="padding-left: 168px; font-size: 15pt;">
        <table style="font-size:15pt;">        
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->id])->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->evidencenamenot->evidence;?></td>                               
                                
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table> 
    </div>
    <p><p>
    <div style=" font-size: 15pt; padding-left: 250px;">
        (ลงชื่อ)................................................<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?= $model->servicename->name;?>)<br>
       ตำแหน่ง &nbsp;&nbsp;<?= $model->servicename->positionname->name;?><br>

    </div>

    <p><p>
    <hr>

    <div style="padding-left: 240px;">
        <strong style="font-size:18pt;">ส่วนของผู้แจ้ง </strong>
    </div><p><p>
    <div style="font-size:15pt;">
        <strong>ใบรับแจ้ง</strong>
    </div><p><p>  
    <div style="font-size: 15pt;">
        ชื่อสถานประกอบกิจการ&nbsp;&nbsp;&nbsp; <?= $model->store_name; ?>
        ประเภท&nbsp;&nbsp;&nbsp; <?= $model->storetype->name; ?>&nbsp;&nbsp;&nbsp;มีพื้นที่&nbsp;&nbsp;&nbsp; <?= $model->store_area; ?>&nbsp;&nbsp;&nbsp;ตารางเมตร
        <br>   
        ตั้งอยู่เลขที่&nbsp;&nbsp;&nbsp; <?= $model->store_addr; ?>&nbsp;&nbsp;&nbsp;หมายเลขโทรศัพท์&nbsp;&nbsp;&nbsp; <?= $model->store_phone; ?><br>                
        เลขที่&nbsp;&nbsp;&nbsp; <?= $model->code_no; ?>&nbsp;&nbsp;&nbsp;ได้รับเรื่องเมื่อวันที่&nbsp;&nbsp;&nbsp; <?= thainumDigit(DateThaiLong($model->date_request)); ?>
        <br>            
        ตรวจสอบแล้ว  เอกสารหลักฐาน  &nbsp;&nbsp;&nbsp; 
        <strong><?php
                if ($model->evidence_complete == '1') {
                    echo 'ครบ';
                } elseif ($model->evidence_complete == '2') {
                    echo 'ไม่ครบ คือ';
                } else {
                    echo '';
                };
                ?>
                </strong>               

    </div>

    <div style="padding-left: 168px; font-size: 15pt;">
        <table style="font-size:15pt;">        
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (ReceiveDetailEvidenceNot::find()->where(['receive_id' => $model->id])->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->evidencenamenot->evidence;?></td>                               
                                
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table> 
    </div>
    <p><p>
    <div style=" font-size: 15pt; padding-left: 250px;">
        (ลงชื่อ)................................................<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?= $model->servicename->name;?>)<br>
        ตำแหน่ง &nbsp;&nbsp;<?= $model->servicename->positionname->name;?><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เจ้าพนักงานท้องถิ่น
    </div>


</body>
</html>



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
