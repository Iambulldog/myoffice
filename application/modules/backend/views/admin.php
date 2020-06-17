 

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">เพิ่มแอดมิน</h1>
<p class="mb-4"></p>

<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card" style="background-color: #fbff0036;">
            <div class="container card-body">
                <h5 class="card-title">กรอกข้อมูล</h5>
                <form method="post" action="backend/add_admin">
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="s_user">Username</label>
                            <input type="text" class="form-control" name="username" required> 
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="s_user">ชื่อ</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="s_user">สกุล</label>
                            <input type="text" class="form-control" name="sername" value="">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="s_user">ชื่อเล่น</label>
                            <input type="text" class="form-control" name="nickname" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="s_user">รหัสผ่าน</label>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-4 mb-4">
                           
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
            รายชื่อแอดมิน
           
    </h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            
            <table class="mb-0 table table-hover" id="tb_all" width="100%" cellspacing="0">
            
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>username</th>
                        <th>ชื่อเล่น</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>เข้าใช้ล่าสุด</th>
                        <th>ip</th>
                        <th>จัดการ</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;
                        foreach ($admin as $k => $val) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$val->username?></td>
                            <td><?=$val->nickname?></td>
                            <td><?=$val->name?></td>
                            <td><?=$val->sername?></td>
                            <td><?=$val->last_login?></td>
                            <td><?=$val->last_ip?></td>
                            <td>
                            <i class="fas fa-fw fa-edit edit"  data-datalist="" title="แก้ไข"></i> |
                                        <i class="fas fa-fw fa-trash remove" data-id="<?= $val->id;?>"  title="ลบ"></i>
                            </td>
                        </tr>
                        <?php $i++; }?>

                </tbody>
         
            </table>
        </div>
    </div>
</div>

</div>

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
        dom: 'frtlip',
       


    });
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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