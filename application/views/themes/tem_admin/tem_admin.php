<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My office</title>

  <!-- Custom fonts for this template-->
  <link href="<?php  echo $this->config->item('tem_admin_vendor'); ?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php  echo $this->config->item('tem_admin_css'); ?>sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?php  echo $this->config->item('bootstrap-select'); ?>dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="<?php  echo $this->config->item('tem_admin_DataTables'); ?>datatables.min.css"/>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  
  

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
        <!--================ Menu Area =================-->
        <?php $this->load->view('themes/tem_admin/header_admin'); ?>
        
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
            <!-- content -->
            <?php $this->load->view('themes/tem_admin/content_admin'); ?>
             <!-- start footer Area -->
            <?php $this->load->view('themes/tem_admin/footer_admin'); ?> 
     </div>    
</div>

  



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 

  <!-- Bootstrap core JavaScript-->
  <script src="<?php  echo $this->config->item('tem_admin_vendor'); ?>jquery/jquery.min.js"></script>
  <script src="<?php  echo $this->config->item('tem_admin_vendor'); ?>bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php  echo $this->config->item('tem_admin_vendor'); ?>jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php  echo $this->config->item('tem_admin_js'); ?>sb-admin-2.min.js"></script>





  <script src="<?php  echo $this->config->item('bootstrap-select'); ?>dist/js/bootstrap-select.min.js"></script>
  <script src="<?php  echo $this->config->item('bootstrap-select'); ?>dist/js/i18n/defaults-en_US.min.js"></script>






<script type="text/javascript" src="<?php  echo $this->config->item('tem_admin_DataTables'); ?>datatables.min.js"></script>
<script type="text/javascript" src="<?php  echo $this->config->item('tem_admin_DataTables'); ?>vfs_fonts.js"></script>





</body>

</html>






