 

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">ออกรายงาน</h1>
<p class="mb-4"></p>

<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card" style="background-color: #fbff0036;">
            <div class="container card-body">
                <h5 class="card-title">เลือกช่วงรายงาน</h5>
                <form method="post" action="report2">
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="">ด่วน</label>
                            <select class="mb-2 form-control selectpicker" name="oth" id="oth">
                                <option value="-" <?php if ($oth == '-') {
                                                        echo "selected";
                                                    } ?>> เลือก </option>
                                <option value="0" <?php if ($oth == '0') {
                                                        echo "selected";
                                                    } ?>> วันนี้ </option>
                                <option value="-1" <?php if ($oth == '-1') {
                                                        echo "selected";
                                                    } ?>> เมื่อวาน </option>
                                <option value="7" <?php if ($oth == '7') {
                                                        echo "selected";
                                                    } ?>> 7 วันก่อน</option>
                                <option value="1" <?php if ($oth == '1') {
                                                        echo "selected";
                                                    } ?>> 1 เดือน </option>
                                <option value="3" <?php if ($oth == '3') {
                                                        echo "selected";
                                                    } ?>> 3 เดือน </option>
                                <option value="6" <?php if ($oth == '6') {
                                                        echo "selected";
                                                    } ?>> 6 เดือน </option>
                            </select>


                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <label for="datebegin">ตั้งแต่วันที่</label>
                            <input type="datetime-local" class="form-control  date" id="datebegin" name="datebegin" placeholder="วันที่เริ่ม" value="<?php echo str_replace(" ","T",$begin);  ?>" required="" onchange="c_date(this.value)">

                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="dateend">ถึงวันที่</label>
                            <input type="datetime-local" class="form-control  date " id="dateend" name="dateend" placeholder="วันที่สิ้นสุด" value="<?php echo str_replace(" ","T",$end); ?>" required="" onchange="c_date()">

                        </div>

                    </div>
                    <div class=row>
                      
                        <div class="col-md-4 mb-4">
                            <label for="s_web">ชื่อเว็บ</label>
                            <select class="mb-2 form-control selectpicker" name="s_web" id="s_web" data-live-search="true" onchange="changeweb(this.value)">
                                <option value="0" selected> ทั้งหมด </option>
                                <?php $i = 1;
                                foreach ($web as $k => $val) { ?>
                                    <option value="<?= $val->id ?>" <?php if ($s_web == $val->id) { echo "selected";  }?> >
                                    <?= $val->name ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        

                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="submit" class=" btn btn-success form-control" value="ตกลง">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="reset" id="reset" class=" btn btn-info form-control" value="ล้างค่า" >
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<hr>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 >
          
             จากเว็บ 
             <span class="m-0 font-weight-bold text-primary">
             <?php 
             if ($s_web != 0){
                foreach ($web as $k => $val) { 
                        if ($s_web == $val->id) { echo $val->name;  }
                } 
            }else{
                echo "ทั้งหมด";
            }
             ?></span>
           
             ตั้งแต่วันที่
             <span class="m-0 font-weight-bold text-primary">
             <?php 
             $begin = date("d/m/Y H:i", strtotime(str_replace(" ","T",$begin)));  
             $end = date("d/m/Y H:i", strtotime(str_replace(" ","T",$end))); 
                echo  $begin."</span> ถึงวันที่ <span class='m-0 font-weight-bold text-primary'>".$end;
               ?></span>
    </h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            
            <table class="mb-0 table table-hover" id="tb_all" width="100%" cellspacing="0">
            
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>เว็บ</th>
                        <th>ยอดฝาก</th>
                        <th>ยอดถอน</th>
                        <th>โบนัส/แนะนำ</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($list_all as $k => $val) { ?>
                            <td> <?= $i ?> </td>
                            <td> <?= $val['web_name'] ?> </td>
                            <td> <?= $val['total_deposit'] ?> </td>
                            <td> <?= $val['total_withdraw'] ?> </td>
                            <td> <?= $val['total_bonus'] ?> </td>
                            
                        </tr>
                    <?php $i++;
                    } ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

</div>
<?php
             
            $title = " จากเว็บ:"; 
             
              
             if ($s_web != 0){
                foreach ($web as $k => $val) { 
                        if ($s_web == $val->id) { $title .=  $val->name;  }
                } 
            }else{
                $title .= "ทั้งหมด ";
            }

            
             $title .= "ตั้งแต่วันที่: ";
             
             
             $begin = date("d/m/Y H:i", strtotime(str_replace(" ","T",$begin)));  
             $end = date("d/m/Y H:i", strtotime(str_replace(" ","T",$end))); 
             $title .=  $begin." ถึงวันที่ ".$end;
               ?>
<script>
$(document).ready(function() {
    var ti = '<?php echo $title;?>'
    $('title').html(ti);
    
    $("#s_user option").each(function() {
        $(this).hide();
        $('#s_user').selectpicker('refresh');
    });
    $("#reset").on("click", function () {
$('#oth').val("-");
$('#type').val(0);
$('#s_web').val(0);
$('#s_user').val(0);
         $('.selectpicker ').selectpicker('refresh');
    });
    pdfMake.fonts = {
        THSarabun: {
            normal: 'THSarabun.ttf',
            bold: 'THSarabun-Bold.ttf',
            italics: 'THSarabun-Italic.ttf',
            bolditalics: 'THSarabun-BoldItalic.ttf'
        }
    }
    $('#tb_all').DataTable({
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        dom: 'Bfrtlip',
        buttons: [
            'excel', { // กำหนดพิเศษเฉพาะปุ่ม pdf
                "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
                "text": 'PDF', // ข้อความที่แสดง
                // "orientation": 'landscape',
                "pageSize": 'A4', // ขนาดหน้ากระดาษเป็น A4            
                "customize": function(doc) { // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
                    // กำหนด style หลัก
                    doc.defaultStyle = {
                        font: 'THSarabun',
                        fontSize: 16
                    };


                }
            }, 'print'
        ],

        "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                var substr = function(d) {
                    return typeof d === 'string' ?
                        d.replace('%', '') * 1 :
                        typeof d === 'number' ?
                        d : d;
                }
                var d = api
                    .column(2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                var w = api
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var b = api
                .column(4)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(0).footer()).html('');
                $(api.column(1).footer()).html('');
                $(api.column(2).footer()).html(d.toFixed(2));
                $(api.column(3).footer()).html(w.toFixed(2));
                $(api.column(4).footer()).html(b.toFixed(2));

               
        },


    });
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function c_date(d) {
    console.log(d);
    
    $('#oth').val('-');
    $('#oth').selectpicker('refresh');
}

function changeweb(id) {


    if (id != 0) {

        $("#s_user option").each(function() {
            $(this).hide();

            if ($(this).data("webid") == id) {
                $(this).show();
            } else {
                $(this).hide();
            }
            $('#s_user').selectpicker('refresh');
        });

    } else {
        $("#s_user option").each(function() {
            $(this).hide();
            $('#s_user').selectpicker('refresh');
        });
        $('#s_user').selectpicker('refresh');
    }

}

function check_f() {


}
</script>