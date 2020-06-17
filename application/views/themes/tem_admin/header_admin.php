<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">My Office <sup>v.1</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php if($menu == 'home'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'home'){echo 'active';}?>" href="<?php echo base_url(); ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>HOME</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">





<!-- Heading -->
<div class="sidebar-heading">
  จัดการข้อมูล 
</div>


<li class="nav-item <?php if($menu == 'deposit_withdraw'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'deposit_withdraw'){echo 'active';}?>" href="<?php echo base_url();?>backend/deposit_withdraw">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span> ฝาก/ถอน</span></a>
</li>


<li class="nav-item <?php if($menu == 'report'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'report'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/report">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>รายงาน</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
  ตั้งค่า
</div>

<?php  if($_SESSION['users']['id']==1){ ?>
  <li class="nav-item <?php if($menu == 'admin'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'admin'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/admin">
    <i class="fas fa-fw fa-cogs"></i>
    <span>ADMIN</span></a>
</li>
<?php } ?>
<li class="nav-item <?php if($menu == 'profile'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'profile'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/profile">
    <i class="fas fa-fw fa-address-card"></i>
    <span>profile</span></a>
</li>


<li class="nav-item <?php if($menu == 'user'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'user'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/user">
    <i class="fas fa-fw fa-users"></i>
    <span>USERS</span></a>
</li>

<li class="nav-item <?php if($menu == 'web'){echo 'active';}?>">
  <a class="nav-link <?php if($menu == 'web'){echo 'active';}?>" href="<?php echo base_url(); ?>backend/web">
    <i class="fas fa-fw fa-globe"></i>
    <span>WEB</span></a>
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