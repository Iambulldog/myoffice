<div class="container-fluid">

          <!-- Page Heading -->
          <?php if($_SESSION['users']['id']==1){?>
          <h1 class="h3 mb-1 text-gray-800">เพิ่มเว็บ</h1>
          <p class="mb-4"></p>

        <div class="container">
        <form method="post" action="addweb" id="f_addweb">
            <input hidden name="id" id="id_web">

                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="webname">ชื่อเว็บ</label>
                    <input type="text" class="form-control" id="webname" name="webname" required>
                    </div>

    <div class="form-group col-md-6">
                    <label for="credit">เครดิต</label>
                    <input type="number" class="form-control" id="credit" name="credit" required>
                    </div>

                 

                </div>
               
                <button id="bt_f" type="button" class="btn btn-success" onclick='check_f();'>บันทึกข้อมูล</button>
                &nbsp;&nbsp;&nbsp;
                <button type="reset" class="btn btn-danger" id="bt_r">ยกเลิก</button>
                </form>

        </div>
                        <?php }?>

        <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ตารางรายการทั้งหมด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                   
                <table class="mb-0 table table-hover" id="tb_web" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อเว็บ</th>
                            <th>เครดิตเหลือ</th>
                            <?php if($_SESSION['users']['id']==1){?>
                                <th>แก้ไข</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; /*echo "<pre>";print_r($data);*/ foreach ($web as $k => $val) {?>
                        <tr>
                            <td><?=$i; ?></td>
                            <td><?=$val->name;?></td>
                            <td ><?=$val->credit;?>
                               
                            </td>
                            <?php if($_SESSION['users']['id']==1){?>
                                <td>
                                    <i class="fas fa-fw fa-edit edit" data-datalist="<?= htmlspecialchars(json_encode($val, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" data-placement="top" title="แก้ไข" ></i>
                                    
                                </td>
                            <?php } ?>
                        </tr>
                    <?php $i++;}?>

                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
         
</div>





<script>
    $(document).ready(function() {

        $('#tb_web').DataTable({
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });


        $(".edit").click(function() {
          
            var d = $(this).data('datalist');
            $("#f_addweb").attr("action", "backend/editweb");
            $("#bt_f").attr("class", "btn btn-warning");
            $("#bt_f").text("แก้ไข");

            $('#id_web').val(d.id);
            $('#webname').val(d.name);
            // $('#credit').val(d.credit);
           
           
        });
        $("#bt_r").click(function() {

                $("#f_addweb").attr("action", "backend/addweb");
                $("#bt_f").attr("class", "btn btn-success");
                $("#bt_f").text("บันทึกข้อมูล");
                $('#webname').val('');
                $('#credit').val('');
        });

       
    });

    function check_f() {
        if($("#webname").val() != ""){
            if (confirm("ยืนยันการเพิ่มเว็บ "+$("#webname").val()) && $("#webname").val() != "") {  
                    $("#f_addweb").submit();  
                } else {   
                    $("#webname").val(""); 
                 }
        }else{
            $("#webname").focus();
        }
    }
</script>



