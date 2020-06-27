<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">เพิ่มเว็บ</h1>
          <p class="mb-4"></p>

        <div class="container">
        <form method="post" action="adduser" id="f_user">
        <input hidden name="id" id="id_user">
                <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputState">WEB</label>
                    <select id="s_web" name="s_web" class="form-control selectpicker" data-live-search="true" required >
                        <option  selected >เลือก...</option>
                        <?php $i=1; foreach ($web as $k => $val) {?>
                            <option value="<?=$val->id?>"><?=$val->name?></option>
                        <?php }?>

                    </select>
                </div>
                    <div class="form-group col-md-4">
                    <label for="nameuser">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" id="nameuser" name="nameuser" required>
                    </div>
                </div>
               
                <button id="bt_f" type="button" class="btn btn-success" onclick='check_f();'>บันทึกข้อมูล</button>
                &nbsp;&nbsp;&nbsp;
                <button type="reset" class="btn btn-danger" id="bt_r">ยกเลิก</button>
                </form>

        </div>


        <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ตารางรายการทั้งหมด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                   
                <table class="mb-0 table table-hover" id="tb_user" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>ชื่อเว็บ</th>
                            <th>แก้ไข</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; /*echo "<pre>";print_r($data);*/ foreach ($user as $k => $val) {?>
                        <tr>
                            <td><?=$i; ?></td>
                            <td><?=$val->name;?></td>
                            <td><?=$val->web_name;?></td>
                            <td>
                                <i class="fas fa-fw fa-edit edit" data-datalist="<?= htmlspecialchars(json_encode($val, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" data-placement="top" title="แก้ไข" onclick="edit(this)"></i> 
                            </td>
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

        $('#tb_user').DataTable({
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });


        $(".edit").click(function() {

            // console.log($(this).data('datalist'));
           
        });



    });

function edit(t){
    document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
    var d = $(t).data('datalist');
            $("#f_user").attr("action", "backend/edituser");
            $("#bt_f").attr("class", "btn btn-warning");
            $("#bt_f").text("แก้ไข");

            $('#id_user').val(d.id);
            $('#s_web').val(d.web_id);
            $('#nameuser').val(d.name);
            $('#s_web').selectpicker('refresh');
}


function check_f() {
    if($("#nameuser").val() != "" && $("#s_user").val() != "เลือก..."){
                                if (confirm("ยืนยันการเพิ่มผู้ใช้ "+$("#nameuser").val()) && $("#nameuser").val() != "") {  
                                        $("#f_user").submit();  
                                } else {   
                                        $("#nameuser").val(""); 
                                }  
                }else{
                    if($("#s_user").val() == "เลือก..."){
                        $('#s_user').selectpicker('toggle');

                       
                    }else if($("#nameuser").val() == ""){
                        $("#nameuser").focus();
                    }
                    
                 }
    
}

</script>



