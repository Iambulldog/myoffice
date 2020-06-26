<div class="container-fluid">
<div class="container">
<div class="row flex-lg-nowrap">


  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $_SESSION['users']['name']." ".$_SESSION['users']['sername'];?></h4>
                    <p class="mb-0">Username: <?php echo $_SESSION['users']['username'];?></p>
                    <div class="text-muted"><small> <?php //echo $_SESSION['users']['last_login'];?></small></div>
                    <div class="mt-2">
                      <button class="btn btn-primary" type="button">
                         
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                      </button>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">administrator</span>
                    <div class="text-muted"><small><!-- Joined 09 Dec 2017 --></small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form"  method="POST" action="backend/editprofile">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>ชื่อ</label>
                              <input class="form-control" type="text" name="name" placeholder="<?php echo $_SESSION['users']['name'];?>" value="<?php echo $_SESSION['users']['name'];?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>สกุล</label>
                              <input class="form-control" type="text" name="sername" placeholder="<?php echo $_SESSION['users']['sername'];?>" value="<?php echo $_SESSION['users']['sername'];?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>ชื่อเล่น</label>
                              <input class="form-control" type="text" name="nickname" placeholder="<?php echo $_SESSION['users']['nickname'];?>" value="<?php echo $_SESSION['users']['nickname'];?>">
                            </div>
                            
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>&nbsp;</label>
                              <button class="form-control btn btn-primary" type="submit" >บันทึก</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                    <style>
                           .btn-show-pass{
                            display: flex;
                            align-items: center;
                            position: absolute;
                            height: 100%;
                            top: 0;
                            right: 20px;
                            padding: 0 5px;
                            cursor: pointer;
                            margin-top: 7px;
                           } 
                    </style>
                    <hr>
                    <form method="POST"  action="backend/editpass">
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2 "><b>เปลี่ยนรหัสผ่าน</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>รหัสผ่านเดิม</label>
                              <span class="btn-show-pass"><i class="fa fa-eye"></i></span>
                              <input class="form-control" name="old_password" type="password" id="old_password" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>รหัสผ่านใหม่</label>
                              <span class="btn-show-pass"><i class="fa fa-eye"></i></span>
                              <input class="form-control" name="password" type="password" id="password" placeholder="">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>ยืนยัน<span class="d-none d-xl-inline">รหัสผ่านใหม่</span></label>
                              <span class="btn-show-pass"><i class="fa fa-eye"></i></span>
                              <input class="form-control" name="confirm_password" type="password" id="confirm_password" placeholder=""></div>
                              <span id="ms_pass"></span>
                          </div>
                        </div>
                        
                      </div>

                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="button" id="btpass">เปลี่ยนรหัสผ่าน</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <button class="btn btn-block btn-secondary">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>
<script>
$(document).ready(function() {
    $(".btn-show-pass").mousedown(function() {
        $(this).parent().find('input').prop('type', 'text');
    });
    $(".btn-show-pass").mouseup(function() {
        $(this).parent().find('input').prop('type', 'password');
    });
    $(".btn-show-pass").mouseout(function() {
        $(this).parent().find('input').prop('type', 'password');
    });


 


    $("#password").change(function() {validatePassword();});
    $("#confirm_password").keyup(function() {validatePassword();});



});
function validatePassword(){
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();
  if(password != confirm_password) {
    $('#ms_pass').text("✖ รหัสไม่ตรงกัน");
  } else {
    $('#ms_pass').text("✔ รหัสตรงกัน");
    $('#btpass').attr('type', 'submit');
  }
}
</script>