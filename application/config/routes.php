<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// LOGIN PAGE
$route['default_controller']   = 'LoginAdminController/index';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
$route['login/admin/init']     = 'LoginAdminController/init';

# ADMIN
// LOGIN, LOGOUT & INIT Default ADMIN
$route['login/admin']  = 'LoginAdminController/index';
$route['logout/admin'] = 'LoginAdminController/logout';
$route['login/init']   = 'LoginAdminController/init';

// ADMIN DASHBOARD
$route['admin/dashboard'] = 'admin/DashboardController/index';

// ADMIN KOPERASI MANAGEMENT
$route['admin/koperasi']                = 'admin/KoperasiController/index';
$route['admin/koperasi/update']['post'] = 'admin/KoperasiController/update';

// ADMIN LIST KODE
$route['admin/list_kode']                = 'admin/ListKodeController/index';
$route['admin/list_kode/store']['post']  = 'admin/ListKodeController/store';
$route['admin/list_kode/update']['post'] = 'admin/ListKodeController/update';
$route['admin/list_kode/destroy/(:num)'] = 'admin/ListKodeController/destroy/$1';

// ADMIN LIST KODE
$route['admin/anggota']               = 'admin/AnggotaController/index';
$route['admin/anggota/create']        = 'admin/AnggotaController/create';
$route['admin/anggota/store']['post'] = 'admin/AnggotaController/store';

// ADMIN RAT
$route['admin/rat']               = 'admin/ratController/index';
$route['admin/rat/create']        = 'admin/ratController/create';
$route['admin/rat/store']['post'] = 'admin/ratController/store';
$route['admin/rat/detail/(:num)'] = 'admin/ratController/detail/$1';