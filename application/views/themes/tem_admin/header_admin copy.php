<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link <?php if($menu == 'home'){echo 'active';}else{echo 'collapsed';}?>" href="<?php echo base_url(); ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>HOME</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">





<!-- Heading -->
<div class="sidebar-heading">
  จัดการข้อมูล 
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php if($menu == 'deposit'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'deposit'){echo 'active';}else{echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#deposit" aria-expanded="true" aria-controls="deposit">
    <i class="fas fa-fw fa-plus-square"></i>
    <span>ฝาก</span>
  </a>
  <div id="deposit" class="collapse <?php if($menu == 'deposit'){echo 'show';}?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">ฝาก:</h6> -->
      <a class="collapse-item <?php if($active == 'deposit_add'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/deposit_add">เพิ่มข้อมูลการฝาก</a>
      <a class="collapse-item <?php if($active == 'deposit_table'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/deposit_table">ตารางการฝาก</a>
      
    </div>
  </div>
</li>


<li class="nav-item <?php if($menu == 'withdraw'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'withdraw'){echo 'active';}else{echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#withdraw" aria-expanded="true" aria-controls="withdraw">
    <i class="fas fa-fw fa-minus-square" ></i>
    <span>ถอน</span>
  </a>
  <div id="withdraw" class="collapse <?php if($menu == 'withdraw'){echo 'show';}?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">:</h6> -->
      <a class="collapse-item <?php if($active == 'withdraw_add'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/withdraw_add">เพิ่มข้อมูลการถอน</a>
      <a class="collapse-item <?php if($active == 'withdraw_table'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/withdraw_table">ตารางการถอน</a>
      
    </div>
  </div>
</li>


<!-- Nav Item - Charts -->
<li class="nav-item <?php if($menu == 'report'){echo 'active';}?>">
  <a class="nav-link <?php if($active == 'report'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/report">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>รายงาน</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
  ตั้งค่า
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php if($menu == 'admin'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'admin'){echo 'active';}else{echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cogs"></i>
    <span>ADMIN</span>
  </a>
  <div id="collapseTwo" class="collapse <?php if($menu == 'admon'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">จัดการแอดมิน:</h6>
      <a class="collapse-item <?php if($active == 'admin_add'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/admin_add">เพิ่มผู้ใช้</a>
      <a class="collapse-item <?php if($active == 'admin_table'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/admin_table">รายชื่อผู้ใช้</a>
    </div>
  </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item <?php if($menu == 'user'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'user'){echo 'active';}else{echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-users"></i>
    <span>USER</span>
  </a>
  <div id="collapseUtilities" class="collapse <?php if($menu == 'user'){echo 'show';}?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">จัดการลูกค้า:</h6>
      <a class="collapse-item <?php if($active == 'user_add'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/user_add">เพิ่มผู้ลูกค้า</a>
      <a class="collapse-item <?php if($active == 'user_table'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/user_table">รายชื่อลูกค้า</a>
      <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
      <a class="collapse-item" href="utilities-other.html">Other</a> -->
    </div>
  </div>
</li>
<li class="nav-item <?php if($menu == 'web'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'web'){echo 'active';}else{echo 'collapsed';}?>" href="#" data-toggle="collapse" data-target="#web" aria-expanded="true" aria-controls="web">
    <i class="fas fa-fw fa-globe"></i>
    <span>WEB</span>
  </a>
  <div id="web" class="collapse <?php if($menu == 'web'){echo 'show';}?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">จัดการเว็บ:</h6>
      <a class="collapse-item <?php if($active == 'web_add'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/web_add">เพิ่มเว็บ</a>
      <a class="collapse-item <?php if($active == 'web_table'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/web_table">รายชื่อเว็บ</a>
      <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
      <a class="collapse-item" href="utilities-other.html">Other</a> -->
    </div>
  </div>
</li>
<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
  <a class="nav-link <?php if($menu == 'deposit'){echo 'active';}else{echo 'collapsed';}?>" href="tables.html">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->