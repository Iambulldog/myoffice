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
                                    <i class="fas fa-fw fa-edit edit" data-datalist="<?= htmlspecialchars(json_encode($val, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" data-placement="top" title="แก้ไข" onclick="edit(this)"></i>|
                                    <i class="fas fa-fw fa-wrench log" data-id="<?= $val->id; ?>" data-placement="top" title="รายกการแก้ไข" data-toggle="modal" data-target="#exampleModalCenter" onclick="log(this)"></i>
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


<!-- Modal -->
<style>
    .modal-dialog {
        /* Width */
        max-width: 90%;
        width: auto !important;
    }

    td i {
        cursor: pointer;
    }
</style>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">บันทึกการแก้ไข</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="mb-0 table table-hover" id="tb_log" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>เว็บ</th>
                                <th>ยอด</th>
                                <th> เวลาลงรายการ </th>
                                <th> IP </th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
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

    function log(h){
    var t = $('#tb_log').DataTable();
            t.clear().draw();
            $.ajax({
                type: "POST",
                url: 'backend/get_weblog',
                data: {
                    id: $(h).data('id')
                },
                success: function(d) {
                    var c = 1;
                    console.log(d);
                    $.each(d, function(key, val) {
  
                        t.row.add([
                            c,
                            val.webname,
                            val.credit,
                            val.date_create,
                            val.ip,
                        ]).draw(false);
                        c++;
                    });



                },
                dataType: 'json'
            });
}

    function edit(t){
        var d = $(t).data('datalist');
            $("#f_addweb").attr("action", "backend/editweb");
            $("#bt_f").attr("class", "btn btn-warning");
            $("#bt_f").text("แก้ไข");

            $('#id_web').val(d.id);
            $('#webname').val(d.name);
}
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



