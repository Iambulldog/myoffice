<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">เพิ่มรายการ</h1>
    <p class="mb-4"></p>

    <div class="container">
        <form method="post" action="backend/addlist" id="f_list">
            <input hidden name="id" id="id_list">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputState">รายการ</label>
                    <select id="s_list" name="s_list" class="selectpicker" data-live-search="true" onchange="list(this.value);" required>
                        <option value="0" selected>เลือก...</option>
                        <option value="1">ฝาก</option>
                        <option value="2">ถอน</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">WEB</label>
                    <select id="s_web" name="s_web" class=" selectpicker" data-live-search="true" required onchange="changeweb(this);">
                        <option value="0" data-web="-1"> เลือก... </option>
                        <?php $i = 1;
                        foreach ($web as $k => $val) {
                            if ($i = 1) {
                            }
                        ?>

                            <option value="<?= $val->id ?>" data-web="<?= $val->credit ?>"><?= $val->name ?></option>
                        <?php $i++;
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">user</label>
                    <select id="s_user" name="s_user" class="selectpicker" data-live-search="true" required>
                        <option value="0" data-webid="">เลือก...</option>
                        <?php $i = 1;
                        foreach ($user as $k => $val) { ?>
                            <option value="<?= $val->id ?>" data-webid="<?= $val->web_id ?>"><?= $val->name ?></option>
                        <?php $i++;
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="slip">เวลาจากสลิป</label>
                    <input type="datetime-local" class="form-control" id="slip" name="slip" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="total">ยอด<span id="text_balance"></span></label>
                    <input type="number" class="form-control" id="total" name="total" required disabled>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputZip">โบนัส/แนะนำ</label>
                    <input type="number" class="form-control" id="bonus" name="bonus" disabled>
                </div>
            </div>
            <div class="form-row">
                <button id="bt_f" type="button" class="btn btn-success" onclick='check_f();'>บันทึกข้อมูล</button>
                &nbsp;&nbsp;&nbsp;
                <button type="reset" class="btn btn-danger" id="bt_r">ยกเลิก</button>
            </div>
        </form>
    </div>

    <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">รายการล่าสุด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="mb-0 table table-hover" id="tb_all" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รายการ</th>
                            <th>เว็บ</th>
                            <th>user</th>
                            <th>ยอด</th>
                            <th>โบนัส/แนะนำ</th>
                            <th> เวลาสลิป </th>
                            <th>ผู้ลงรายการ</th>
                            <th> เวลาลงรายการ </th>
                            <th> แก้ไข </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($list_all as $k => $val) { ?>
                            <tr style="<?php if ($val->list == 1) {/*ฝาก*/
                                            echo "background-color: #b1ffe255;";
                                        }
                                        if ($val->list == 2) {/*ถอน*/
                                            echo " background-color: #fdacac55;";
                                        }
                                        if ($val->status == 0) {
                                            echo "background-color: #00000033;";
                                        } ?>">
                                <td> <?= $i ?> </td>
                                <td> <?php if ($val->list == 1) {
                                            echo "ฝาก";
                                        } elseif ($val->list == 2) {
                                            echo "ถอน";
                                        } ?> </td>
                                <td> <?= $val->web_name ?> </td>
                                <td> <?= $val->name_user ?> </td>
                                <td> <?php if ($val->list == 1) {
                                            echo "+";
                                        } elseif ($val->list == 2) {
                                            echo "-";
                                        } ?><?= $val->total ?> </td>
                                <td> <?= $val->bonus ?> </td>
                                <td> <?= $val->slip ?> </td>
                                <td> <?= $val->admin_name ?></td>
                                <td><?= $val->time_create ?> </td>
                                <td>
                                    <?php if ($_SESSION['users']['id'] == $val->admin_id) {
                                        if ($val->status != 0) {
                                    ?>
                                            <i class="fas fa-fw fa-edit edit" data-datalist="<?= htmlspecialchars(json_encode($val, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" data-placement="top" title="แก้ไข" onclick="edit(this)"></i> |
                                            <i class="fas fa-fw fa-trash remove" data-id="<?= htmlspecialchars(json_encode($val, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" data-placement="top" title="ลบ" onclick="del(this)"></i>|

                                        <?php } else { ?>

                                            <!-- <i class="fas fa-fw fa-recycle recycle" data-id="<?= htmlspecialchars(json_encode($val, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" data-placement="top" title="กู้คืน"></i> -->

                                    <?php }
                                    } else {
                                        echo "";
                                    } ?>

                                    <?php if ($val->status == 2) { ?>
                                        <i class="fas fa-fw fa-wrench log" data-id="<?= $val->id; ?>" data-placement="top" title="รายกการแก้ไข" data-toggle="modal" data-target="#exampleModalCenter" onclick="log(this)"></i>
                                    <?php } ?>

                                </td>
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
                                <th>รายการ</th>
                                <th>เว็บ</th>
                                <th>user</th>
                                <th>ยอด</th>
                                <th>โบนัส/แนะนำ</th>
                                <th> เวลาสลิป </th>
                                <th>ผู้ลงรายการ</th>
                                <th> เวลาลงรายการ </th>
                                <th> เวลาแก้ไข </th>
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
var balance=0;
    $(document).ready(function() {
        
        $("#s_user option").each(function() {
            $(this).hide();
            $('#s_user').selectpicker('refresh');
        });
        $('#tb_all').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            dom: 'frtlip',
        });
  


        $("#bt_r").click(function() {

            $("#f_list").attr("action", "backend/addlist");
            $("#bt_f").attr("class", "btn btn-success");
            $("#bt_f").text("บันทึกข้อมูล");
            $('#s_list').val(0);
            $('#s_web').val(0);
            $('#s_user').val(0);
            $('.selectpicker ').selectpicker('refresh');
        });
        // ================  edit  =======================
        $(".edit").click(function() {
           
        });
        // ================== /remove ====================
        $(".remove").click(function() {
            // console.log($(this).data('id'));

        });
        // ================== /กู้คืน ====================
        $(".recycle").click(function() {
            console.log($(this).data('id'));

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'กู้คืนรายการ',
                text: "ยืนยันการกู้คืนรายการหรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน!!!',
                cancelButtonText: 'ยกเลิก!!!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'ยืนยัน',
                        'กู้คืนได้',
                        'success'
                    );
                    // ====
                    $.ajax({
                        type: "POST",
                        url: 'backend/recycle',
                        data: {
                            id: $(this).data('id')
                        },
                        success: function(d) {
                            if (d) {
                                location.href = '<?php echo base_url('backend/deposit_withdraw') ?>';
                            } else {
                                console.log("0");

                            }
                        },
                        dataType: 'json'
                    });

                    // ====

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'ยกเลิก',
                        ' :)',
                        'error'
                    )
                }
            })
        });


        // ========================== show log ======================
        $(".log").click(function() {
            console.log($(this).data('id'));

     
        });

// ========================== Total ======================
        $("#total").keyup(function(){

          if( parseFloat($(this).val()) > parseFloat(balance)){
            $("#total").val('');
          }
        });

    });

function del(t){
    const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'ลบรายการ',
                text: "ยืนยันการลบรายการหรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน!!!',
                cancelButtonText: 'ยกเลิก!!!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'ยืนยัน',
                        'รายการจะยังอยู่ สามารถกู้คืนได้',
                        'success'
                    );
                    // ====
                    $.ajax({
                        type: "POST",
                        url: 'backend/remove',
                        data: {
                            data: $(t).data('id')
                        },
                        success: function(d) {
                            if (d) {
                                location.href = '<?php echo base_url('backend/deposit_withdraw') ?>';
                            } else {
                                console.log("0");

                            }
                        },
                        dataType: 'json'
                    });

                    // ====

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'ยกเลิก',
                        ' :)',
                        'error'
                    )
                }
            });
}
function log(h){
    var t = $('#tb_log').DataTable();
            t.clear().draw();
            $.ajax({
                type: "POST",
                url: 'backend/get_log',
                data: {
                    id: $(h).data('id')
                },
                success: function(d) {
                    var c = 1;
                    // console.log(d);

                    $.each(d, function(key, val) {
                        var list = "";
                        if (val.list == 1) {
                            list = "ฝาก";
                        } else if (val.list == 2) {
                            list = "ถอน";
                        }
                        t.row.add([
                            c,
                            list,
                            val.web_name,
                            val.name_user,
                            val.total,
                            val.bonus,
                            val.slip,
                            val.admin_name,
                            val.time_create,
                            val.time_create_log,
                        ]).draw(false);
                        c++;
                    });



                },
                dataType: 'json'
            });
}
function edit(t){
    $('#total').removeAttr('disabled');
    document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
            // console.log($(this).data('id'));
            var d = $(t).data('datalist');
            $("#f_list").attr("action", "backend/editlist");
            $("#bt_f").attr("class", "btn btn-warning");
            $("#bt_f").text("แก้ไข");


            $('#id_list').val(d.id);
            $('#s_list').val(d.list);
            $('#s_web').val(d.web_id);
            $('#s_user').val(d.user_id);
            $('#total').val(d.total);
            $('#bonus').val(d.bonus);
            // console.log(GetFormattedDate(d.slip));

            $('#slip').val(GetFormattedDate(d.slip));
            $('#slip').removeAttr('disabled');
            $('#bonus').removeAttr('disabled');
            balance = ($('#s_web').find('option:selected').data('web'));
            $('#text_balance').text(' ไม่เกิน : '+parseFloat(balance));

            $('.selectpicker').selectpicker('refresh');

}

    function list(d) {
        if (d == 1) {
            $('#bonus').removeAttr('disabled');
            $('#slip').removeAttr('disabled');
        } else {
            
        }
    }

    function changeweb(t) {

       
        $('#total').removeAttr('disabled');
balance = ($(t).find('option:selected').data('web'));
        $('#text_balance').text(' ไม่เกิน : '+parseFloat(balance));
var id = $(t).val();
        $('#s_user').val(0);
        $('#s_user').selectpicker('refresh');
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
        if ($("#s_list").val() != 0 && $("#s_web").val() != 0 && $("#s_user").val() != 0 && $("#total").val() != "" && $("#slip").val() != "") {



            Swal.fire({
                title: "ยืนยันเพิ่มรายการ " + $("#s_list").find('option:selected').text(),
                html: "<br> เว็บ  ::" + $("#s_web").find('option:selected').text() +
                    "<br> ผู้ใช้  ::" + $("#s_user").find('option:selected').text() +
                    "<br> ยอด  ::" + $("#total").val() +
                    "<br> โบนัส/แนะนำ  ::" + $("#bonus").val(),
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SAVE'
            }).then((result) => {
                if (result.value) {
                    // Swal.fire(
                    //     'สำเร็จ',
                    //     "บันทึกรายการสำเร็จ ",
                    //     'success'
                    // );
                    $("#f_list").submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $("#total").val("");
                }
            })

        } else {
            if ($("#s_list").val() == 0) {
                $('#s_list').selectpicker('toggle');
            } else if ($("#s_web").val() == 0) {
                $('#s_web').selectpicker('toggle');
            } else if ($("#s_user").val() == 0) {
                $('#s_user').selectpicker('toggle');
            } else if ($("#slip").val() == "") {
                $('#slip').focus();
            } else if ($("#total").val() == "") {
                $('#total').focus();
            }

        }

    }

    function GetFormattedDate(d) {
        var todayTime = new Date(d);
        var month = ('0' + (todayTime.getMonth() + 1)).slice(-2);
        var day = ('0' + todayTime.getDate()).slice(-2);
        var year = (todayTime.getFullYear());
        var h = ('0' + todayTime.getHours()).slice(-2);
        var s = ('0' + todayTime.getMinutes()).slice(-2);
        return year + "-" + month + "-" + day + "T" + h + ":" + s;
    }
</script>