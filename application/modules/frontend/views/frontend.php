<!-- slider_area_start -->
<?php 
  if(isset($_SESSION['member'])){
    $ch_log = 1; 
  }else{
    $ch_log = 0;  
  }
  
  ?>
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <!-- <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">Get Loan for your Business growth or startup</h3>
                            <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                                <a href="#" class="boxed-btn3">How it Works</a>
                            </div> -->
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="payment_form white-bg wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
               
                        <?php 
                        if ($ch_log == 1) {
                            // print_r($_SESSION['member']);
                            ?>
                             <div class="info text-center">
                                <h4><div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div><?php  echo $_SESSION['member']['username'];?></h4>
                                <p style="margin-bottom: 1px;margin-top: 1px;"><h3>คงเหลือ ::  ฿ <?php  echo $_SESSION['member']['balance'];?></h3></p>
                            </div>
                                
                            </div>
                           
                            <?php
                        } else { ?>
                            <div class="info text-center">
                                <h4>เข้าสู่รบบ</h4>
                            </div>
                            <?php
                                    if($this->session->flashdata('message'))
                                    {
                                        echo '
                                        <div class="alert alert-danger">
                                            '.$this->session->flashdata("message").'
                                        </div>
                                        ';
                                    }
                                ?>
                            <form  role="form" method="POST" action="<?php echo base_url('frontend/login'); ?>" >
                            <div class="form">
                              
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="input-group-icon mt-10">
                                            <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                            <input type="text" id="username" name="username" placeholder="username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'username'" required="" class="single-input">
                                        </div>

                                    </div>
                                    <div class="col-lg-12">

                                        <div class="input-group-icon mt-10">
                                            <div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                            <input type="password" name="password"  placeholder="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'password'" required="" class="single-input">
                                            <span ><?php echo form_error('password'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                            <div class="submit_btn">
                                <button class="boxed-btn3" type="submit">LOGIN</button>
                            </div>
                            </form>
                            <br>
                            <div class="info text-center">
                                <span>ขอรับสูตร ต่ออายุสูตร</span>
                            </div>

                        <?php   } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- service_area_start  -->
<div class="service_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-60">
                    <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"></span>
                    <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">LIVE-SCORE</h3>
                    <!-- <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">We provide online instant cash loans with quick approval that suit your term</p> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay=".2s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.3s" data-wow-delay=".3s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.4s" data-wow-delay=".4s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay=".2s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.3s" data-wow-delay=".3s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.4s" data-wow-delay=".4s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single_service wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s">

                    <div class="service_icon_wrap text-center">
                        <div class="info text-center">
                            <h3> league-Name </h3>
                        </div>
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam1</span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <h4>Kickoff : 23:00</h4>
                    </div>
                    <div class="service_icon_wrap text-center">
                        <div class="service_icon ">
                            <img src="<?php echo $this->config->item('tem_frontend_img'); ?>svg_icon/service_1.png" alt="">
                            <div class="info text-center">
                                <span>Theam2</span>
                            </div>
                        </div>
                    </div>

                    <div class="service_content">
                        <div class="apply_btn">
                            <button class="boxed-btn3" <?php if ($ch_log == 0) {
                                                            echo 'onclick="javascript:alert(\'เข้าสู่ระบบ\');document.getElementById(\'username\').focus();"';
                                                        } else {
                                                            echo 'type="submit"';
                                                        } ?>>LIVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- service_area_end  -->

<div class="container">
<p><hr></p>
<div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-60">
                    <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"></span>
                    <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">ตารางคะแนน</h3>
                    <!-- <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">We provide online instant cash loans with quick approval that suit your term</p> -->
                </div>
            </div>
        </div>
    <div class="scoretable" >
        <div class="scoretable_menu" style="background: #FFF; color: #000;">
            <div class="scoretable_menu_img"><img src="http://www.soccersuck.com/img/web/ss_scores_icon_pre.png" alt=""></div>
            <div class="scoretable_menu_text" style="margin: 0px 0px 0px 0px;">PREMIER</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="1"></p>
        </div>
        <div class="scoretable_menu" style="background: #0072bb;">
            <div class="scoretable_menu_img"><img src="http://www.soccersuck.com/img/web/ss_scores_icon_la_liga.png" alt=""></div>
            <div class="scoretable_menu_text">LA LIGA</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="2"></p>
        </div>
        <div class="scoretable_menu" style="background: #2e3192;">
            <div class="scoretable_menu_img"><img src="http://www.soccersuck.com/img/web/ss_scores_icon_serie_a.png" alt=""></div>
            <div class="scoretable_menu_text">SERIA A</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="3"></p>
        </div>
        <div class="scoretable_menu" style="background: #f78e55;">
            <div class="scoretable_menu_img"><img src="http://www.soccersuck.com/img/web/ss_scores_icon_bundes.png" alt=""></div>
            <div class="scoretable_menu_text">BUNDES</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="4"></p>
        </div>
        <div class="scoretable_menu thai-league" style="background: #ed1b24;">
            <div class="scoretable_menu_img"><img src="http://soccersuck.com/img/web/thaileague.png" alt=""></div>
            <div class="scoretable_menu_text">THAI LEAGUE</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="5"></p>
        </div>
        <div class="scoretable_menu" style="background: #fff000;">
            <div class="scoretable_menu_img"><img src="http://www.soccersuck.com/img/web/ss_scores_icon_france.png" alt=""></div>
            <div class="scoretable_menu_text" style="color: #000;">FRANCE</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="6"></p>
        </div>
        <div class="scoretable_menu" style="background: #ffffff;">
            <div class="scoretable_menu_img"><img src="http://www.soccersuck.com/img/web/ss_scores_icon_japan.png" alt=""></div>
            <div class="scoretable_menu_text" style="color: #000;">J League</div>
            <div class="clear">&nbsp;</div>
            <p><input type="hidden" value="7"></p>
        </div>
        <div class="clear">&nbsp;</div>
        <div class="scoretable_show">
            <div class="scoretable_showHead"><span>PREMIER TABLE</span></div>
            <p class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s"> <?php echo ($tb); ?></p>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {



        $('.scoretable_menu').click(function() {
            var tbid = $(this).find('input').val();
            var tbname = $(this).find('.scoretable_menu_text').html();

            $('.score_tb').find('tr').hide();
            $('.score_tb').find('thead').find('tr').show();
            $('.score_tb').find('.trLeage' + tbid).show();
            $('.scoretable_showHead').find('span').html(tbname);
            $('.sbnoti').hide();
            $('.trLeagenoyice' + tbid).show();
        });
        $('.scoretabletop_menu').click(function() {
            var tbid = $(this).find('input').val();
            var tbname = $(this).find('.scoretable_menu_text').html();
            $('.score_tbtop').find('tr').hide();
            $('.score_tbtop').find('thead').find('tr').show();
            $('.score_tbtop').find('.trLeage' + tbid).show();
            $('.scoretabletop_showHead').find('span').html(tbname);
        });
    });
</script>
<style>
    table.score_tb {
        width: 100%;
    }

    .scoretable {
        background: #FFF;
        width: 100%;
        padding: 0px 0px 2px 0px;
        box-shadow: 0px 6px 15px #888;
        margin: 3px 0px 0px 0px;
        font-family: 'Arial';
    }

    .scoretable_menu {
        margin: 2px 0px 0px 2px;
        width: 13.8%;
        height: 60px;
        color: #FFF;
        float: left;
        font-size: 11px;
        font-weight: bold;
        cursor: pointer;
    }

    .scoretable_show {
        width: 98%;
        margin: 2px;
    }

    .scoretable_showHead,
    .scoretabletop_showHead {
        background: #ebebeb;
        margin: 2px;
        padding: 2px;
        font-size: 13px;
        font-weight: bold;
        padding: 10px 14px;
    }

    .score_tb {
        border: 1px solid #FFF;
    }

    .clear {
        clear: both;
    }

    .score_tb tr {
        font-weight: bold;
        border: 1px solid #FFF;
    }

    .score_tb td {
        border: 1px solid #FFF;
        padding: 5px 0;
    }
</style>