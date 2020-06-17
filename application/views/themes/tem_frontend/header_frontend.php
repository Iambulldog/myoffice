  <!-- header-start -->
  <?php 
  if(isset($_SESSION['member'])){
    $ch_log = 1; 
  }else{
    $ch_log = 0;  
  }
  
  ?>
  <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <!-- <li><a href="index.html">home</a></li>
                                            <li><a href="Loan.html">Loan</a></li>
                                            <li><a href="about.html">about</a></li>
                                            <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="apply.html">apply loan</a></li>
                                                    <li><a href="elements.html">elements</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="single-blog.html">single-blog</a></li>
                                                </ul>
                                            </li> 
                                            <li><a href="FAQ.html">FAQ</a></li>
                                            <li><a href="contact.html">Contact</a></li>-->
                                            <li><a href="FAQ.html">MENU1</a></li>
                                            <li><a href="contact.html">MENU2</a></li>
                                            <?php  if($ch_log==1){?>
                                                <li><a href="FAQ.html">MENU3</a></li>
                                                <li><a href="contact.html">MENU4</a></li>
                                            <?php }?>
                                             
                                           
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3  d-lg-block">
                                <div class="Appointment">
                                    <div class="phone_num  d-xl-block">
                                        <a href="#"> <i class="fa fa-phone"></i> @LINE999</a>
                                    </div>
                                    <div class=" d-lg-block" style="padding-right: 8%;">
                                    
                                        <?php  if($ch_log==1){?>
                                            <a class="boxed-btn4" href="frontend/logout">LOGOUT</a>
                                     <?php }else{?>
                                             <a class="boxed-btn4" onclick="javascript:document.getElementById('username').focus();">LOGIN</a>
                                       <?php }?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->