function loadSmartCard() {
    $.ajax({
        url: 'http://localhost:8084/smartcard/data/',
        method: 'GET',
        dataType: "json",
        success: function (data) {
            var text_obj = data.address.split('####'); // ข้อมูล ตำบล อำเภอ จังหวัด
            var address = text_obj[0].split('#หมู่ที่'); //สว่นเลขที่บ้านและหมู่
            var addr = address[0]; //เลขที่อยู๋
            var moo = address[1] //หมู่

            var obj = text_obj[1].split('#'); // แยกข้อมูลออกเป็นส่วนๆ โดยใช้เครื่องหมาย # เป็นตัวคัดแยก
            var tmb = obj[0].split(',ตำบล'); // แยกมาแล้วตัดคำว่า ตำบล
            var amp = obj[1].split(',อำเภอ');  // แยกมาแล้วตัดคำว่า อำเภอ
            var province = obj[2].split(',จังหวัด');  // แยกมาแล้วตัดคำว่า จังหวัด

// แปลงวันเกิด
            var dob = data.dob //วันเดือนปีเกิด
            var year = dob.substring(0, 4);
            var month = dob.substring(4, 6);
            var day = dob.substring(6, 8);
            var dob_date = day + '/' + month + '/' + year;
            // $('#result').html(date);
            var yInt = parseInt(year) - 543;
            var getDate = (yInt + '-' + month + '-' + day)
            getAge(getDate);


            $('#receive-store_own_dob').val(dob_date); // วันเกิด
            $('#receive-store_own_moo').val(moo)
            $('#receive-store_own_tmb').val(tmb)
            $('#receive-store_own_amp').val(amp)
            $('#receive-store_own_chw').val(province)
            $('#receive-store_own_addr').val(addr + ' หมู่ที่ ' + moo + ' ' + tmb + ' ' + amp + ' ' + province);
            //$('#receive-store_addr').val(addr+' หมู่'+moo+' ตำบล'+tum+' อำเภอ'+aum+' จังหวัด'+province);
            $('#receive-store_own_cid').val(data.cid)
            $('#receive-store_own_sex').val(data.gender)
            $('#receive-store_own_pname').val(data.prename)
            $('#receive-store_own_fname').val(data.fname)
            $('#receive-store_own_lname').val(data.lname)           
            $('#receive-store_own_dob').val(getDate);

        }
    });

}


function getAge(date)
{
    $.ajax({
        url: 'index.php?r=license/receive/get-age',
        data: {birthday: date},
        success: function (data) {
            $('#receive-store_own_age').val(data.age);
        }
    });

}

function getToHome() {
    $.ajax({
        url: 'index.php?r=license/receive/tohome',
        data: {cid: $('#receive-store_own_cid').val()},
        success: function (data) {
            $('#receive-store_addr').val(data.house);
            $('#receive-store_moo').val(data.village);
            $('#receive-store_tmb').val(data.tambon);
            $('#receive-store_amp').val(data.ampur);
            $('#receive-store_chw').val(data.changwat);



        }
    });

}

function CloneSmartCard() {
    $('#receive-store_addr').val($('#receive-store_own_addr').val());
    $('#receive-store_moo').val($('#receive-store_own_moo').val());
    $('#receive-store_tmb').val($('#receive-store_own_tmb').val());
    $('#receive-store_amp').val($('#receive-store_own_amp').val());
    $('#receive-store_chw').val($('#receive-store_own_chw').val());

}

function getToMap() {
    $.ajax({
        url: 'index.php?r=license/store-at/tomap',
        data: {cid: $('#storeat-store_own_cid').val()},
        success: function (data) {
            $('#storeat-lat').val(data.latitude);
            $('#storeat-lng').val(data.longitude);

        }
    });

}
//
//function getPersonToReg() {
//    $.ajax({
//        url: 'index.php?r=license/receive/persontohome',
//        data: {cid: $('#receive-store_own_cid').val()},
//        success: function (data) {
//            $('#receive-store_addr').val(data.house);
//            $('#receive-store_moo').val(data.village);
//            $('#receive-store_tmb').val(data.tambon);
//            $('#receive-store_amp').val(data.ampur);
//            $('#receive-store_chw').val(data.changwat);
//
//
//
//        }
//    });
//
//}
