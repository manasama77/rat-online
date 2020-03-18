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
$route['admin/anggota']                = 'admin/AnggotaController/index';
$route['admin/anggota/create']         = 'admin/AnggotaController/create';
$route['admin/anggota/store']['post']  = 'admin/AnggotaController/store';
$route['admin/anggota/reset']['post']  = 'admin/AnggotaController/reset';
$route['admin/anggota/edit/(:num)']    = 'admin/AnggotaController/edit/$1';
$route['admin/anggota/update']['post'] = 'admin/AnggotaController/update';
$route['admin/anggota/destroy/(:num)'] = 'admin/AnggotaController/destroy/$1';

// ADMIN RAT
$route['admin/rat']                                = 'admin/ratController/index';
$route['admin/rat/penetapan/(:num)']               = 'admin/ratController/penetapan/$1';
$route['admin/rat/penetapan_manual/(:num)']        = 'admin/ratController/penetapan_manual/$1';
$route['admin/rat/store_penetapan_manual']['post'] = 'admin/ratController/store_penetapan_manual';
$route['admin/rat/create']                         = 'admin/ratController/create';
$route['admin/rat/store']['post']                  = 'admin/ratController/store';
$route['admin/rat/detail/(:num)']                  = 'admin/ratController/detail/$1';
$route['admin/rat/delete_file/(:num)/(:num)']      = 'admin/ratController/delete_file/$1/$2';
$route['admin/rat/store_polling']['post']          = 'admin/ratController/store_polling';
$route['admin/rat/upload']['post']                 = 'admin/ratController/upload';
$route['admin/rat/read/(:num)/(:num)']             = 'admin/ratController/read/$1/$2';
$route['admin/rat/store_respon']['post']           = 'admin/ratController/store_respon';
$route['admin/rat/destroy/(:num)']                 = 'admin/ratController/destroy/$1';