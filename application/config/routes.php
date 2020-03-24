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
$route['admin/rat']                                = 'admin/RatController/index';
$route['admin/rat/aktifkan/(:num)/(:any)']             = 'admin/RatController/aktifkan/$1/$2';
$route['admin/rat/pembukaan']                      = 'admin/RatController/pembukaan';
$route['admin/rat/penetapan/(:num)/(:any)']        = 'admin/RatController/penetapan/$1/$2';
$route['admin/rat/penetapan_manual/(:num)/(:any)'] = 'admin/RatController/penetapan_manual/$1/$2';
$route['admin/rat/penutupan']                      = 'admin/RatController/penutupan';
$route['admin/rat/store_penetapan_manual']['post'] = 'admin/RatController/store_penetapan_manual';
$route['admin/rat/create']                         = 'admin/RatController/create';
$route['admin/rat/store']['post']                  = 'admin/RatController/store';
$route['admin/rat/detail/(:num)']                  = 'admin/RatController/detail/$1';
$route['admin/rat/delete_file/(:num)/(:num)']      = 'admin/RatController/delete_file/$1/$2';
$route['admin/rat/store_polling']['post']          = 'admin/RatController/store_polling';
$route['admin/rat/upload']['post']                 = 'admin/RatController/upload';
$route['admin/rat/read/(:num)/(:num)']             = 'admin/RatController/read/$1/$2';
$route['admin/rat/store_respon']['post']           = 'admin/RatController/store_respon';
$route['admin/rat/edit/(:num)']                    = 'admin/RatController/edit/$1';
$route['admin/rat/destroy/(:num)']                 = 'admin/RatController/destroy/$1';
$route['admin/rat/update']['post']                 = 'admin/RatController/update';
$route['admin/rat/vote_pengurus']                  = 'admin/RatController/vote_pengurus';
$route['admin/rat/store_vote_pengurus']['post']    = 'admin/RatController/store_vote_pengurus';
$route['admin/rat/store_penutupan']['post']        = 'admin/RatController/store_penutupan';