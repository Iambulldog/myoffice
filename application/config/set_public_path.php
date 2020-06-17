<?php

$CI =& get_instance();

$config['root_url'] = $CI->config->base_url().'public/';

// =============== tem_frontend =======================
$config['tem_frontend'] = $config['root_url'] . 'tem_frontend/';
$config['tem_frontend_css'] = $config['tem_frontend'] . 'css/';
$config['tem_frontend_fonts'] = $config['tem_frontend'] . 'fonts/';
$config['tem_frontend_img'] = $config['tem_frontend'] . 'img/';
$config['tem_frontend_js'] = $config['tem_frontend'] . 'js/';
$config['tem_frontend_scss'] = $config['tem_frontend'] . 'scss/';
// $config['tem_frontend_vendors'] = $config['tem_frontend'] . 'vendors/';
// =============== END tem_frontend =======================


// =============== tem_admin ==============================
$config['tem_admin'] = $config['root_url'] . 'tem_admin/';
$config['tem_admin_css'] = $config['tem_admin'] . 'css/';
$config['tem_admin_scss'] = $config['tem_admin'] . 'scss/';
$config['tem_admin_img'] = $config['tem_admin'] . 'img/';
$config['tem_admin_js'] = $config['tem_admin'] . 'js/';
$config['tem_admin_vendor'] = $config['tem_admin'] . 'vendor/';

$config['bootstrap-select'] = $config['tem_admin'] . 'bootstrap-select-1.13.14/';
$config['tem_admin_DataTables'] = $config['tem_admin'] . 'DataTables/';

// =============== END tem_admin ==============================

// =============== login ==============================
$config['tem_login'] = $config['root_url'] . 'login/';
$config['tem_login_css'] = $config['tem_login'] . 'css/';
$config['tem_login_fonts'] = $config['tem_login'] . 'fonts/';
$config['tem_login_images'] = $config['tem_login'] . 'images/';
$config['tem_login_js'] = $config['tem_login'] . 'js/';
$config['tem_login_vendor'] = $config['tem_login'] . 'vendor/';

?>
