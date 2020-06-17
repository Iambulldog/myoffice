<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">เพิ่มเว็บ</h1>
          <p class="mb-4"></p>

        <div class="container">
        <form method="post" action="addweb" id="f_addweb">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="webname">ชื่อเว็บ</label>
                    <input type="text" class="form-control" id="webname" name="webname" required>
                    </div>
                </div>
               
                <button type="button" class="btn btn-success" onclick='
                javascript:if($("#webname").val() != ""){
                                if (confirm("ยืนยันการเพิ่มเว็บ "+$("#webname").val()) && $("#webname").val() != "") {  
                                        $("#f_addweb").submit();  
                                } else {   
                                        $("#webname").val(""); 
                                }  
                           }else{$("#webname").focus();}
                '> บันทึกข้อมูล</button>
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
                   
                <table class="mb-0 table table-hover" id="tb_web" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อเว็บ</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; /*echo "<pre>";print_r($data);*/ foreach ($web as $k => $val) {?>
                        <tr>
                            <td><?=$i; ?></td>
                            <td><?=$val->name;?></td>
                           
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
    });


</script>



