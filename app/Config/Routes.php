<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ====================== HALAMAN AWAL & AUTH ======================
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

// Redirect dashboard sesuai role (dipakai filter auth saja, lalu redirect manual di controller)
$routes->get('/dashboard', 'AuthController::dashboard', ['filter' => 'auth']);

// ====================== ADMIN ======================
$routes->group('admin', ['filter' => 'adminOnly', 'namespace' => 'App\Controllers\Admin'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    // Kelola User
    $routes->get('user', 'UserController::index');
    $routes->get('user/create', 'UserController::create');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->post('user/update/(:num)', 'UserController::update/$1');
    $routes->get('user/delete/(:num)', 'UserController::delete/$1');
    $routes->get('karyawan/generate-nik', 'KaryawanController::generateNik');
    
    // Kelola Departemen
    $routes->get('departemen', 'DepartemenController::index');
    $routes->post('departemen/store', 'DepartemenController::store');
    $routes->post('departemen/update/(:num)', 'DepartemenController::update/$1');
    $routes->get('departemen/delete/(:num)', 'DepartemenController::delete/$1');

    // Kelola Jabatan
    $routes->get('jabatan', 'JabatanController::index');
    $routes->post('jabatan/store', 'JabatanController::store');
    $routes->post('jabatan/update/(:num)', 'JabatanController::update/$1');
    $routes->get('jabatan/delete/(:num)', 'JabatanController::delete/$1');

    // Kelola Data Karyawan
    $routes->get('karyawan', 'KaryawanController::index');
    $routes->get('karyawan/create', 'KaryawanController::create');
    $routes->post('karyawan/store', 'KaryawanController::store');
    $routes->get('karyawan/edit/(:num)', 'KaryawanController::edit/$1');
    $routes->post('karyawan/update/(:num)', 'KaryawanController::update/$1');
    $routes->get('karyawan/delete/(:num)', 'KaryawanController::delete/$1');
    $routes->get('karyawan/detail/(:num)', 'KaryawanController::detail/$1');
});

// ====================== HRD ======================
$routes->group('hrd', ['filter' => 'hrdOnly', 'namespace' => 'App\Controllers\Hrd'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    // Data Karyawan (lihat saja)
    $routes->get('karyawan', 'KaryawanController::index');
    $routes->get('karyawan/detail/(:num)', 'KaryawanController::detail/$1');

    // Hak Cuti
    $routes->get('hak-cuti', 'HakCutiController::index');
    $routes->post('hak-cuti/update/(:num)', 'HakCutiController::update/$1');
    $routes->post('hak-cuti/generate', 'HakCutiController::generate');

    // Pengajuan Izin
    $routes->get('izin', 'IzinController::index');
    $routes->get('izin/detail/(:num)', 'IzinController::detail/$1');
    $routes->post('izin/proses/(:num)', 'IzinController::proses/$1');
    $routes->get('izin/delete/(:num)', 'IzinController::delete/$1');

    // Pengajuan Cuti
    $routes->get('cuti', 'CutiController::index');
    $routes->get('cuti/detail/(:num)', 'CutiController::detail/$1');
    $routes->post('cuti/proses/(:num)', 'CutiController::proses/$1');
    $routes->get('cuti/delete/(:num)', 'CutiController::delete/$1');

    // Laporan
    $routes->get('laporan/izin', 'LaporanController::izin');
    $routes->get('laporan/izin/pdf', 'LaporanController::izinPdf');
    $routes->get('laporan/cuti', 'LaporanController::cuti');
    $routes->get('laporan/cuti/pdf', 'LaporanController::cutiPdf');
    $routes->get('laporan/izin/excel', 'LaporanController::izinExcel');
    $routes->get('laporan/cuti/excel', 'LaporanController::cutiExcel');

    $routes->get('profil', 'ProfilController::index');
    $routes->post('profil/ganti-password', 'ProfilController::gantiPassword');
});

// ====================== KARYAWAN ======================
$routes->group('karyawan', ['filter' => 'karyawanOnly', 'namespace' => 'App\Controllers\Karyawan'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    // Profil
    $routes->get('profil', 'ProfilController::index');
    $routes->post('profil/update', 'ProfilController::update');

    // Pengajuan Izin
    $routes->get('izin', 'IzinController::index');
    $routes->get('izin/create', 'IzinController::create');
    $routes->post('izin/store', 'IzinController::store');
    $routes->get('izin/detail/(:num)', 'IzinController::detail/$1');

    // Pengajuan Cuti
    $routes->get('cuti', 'CutiController::index');
    $routes->get('cuti/create', 'CutiController::create');
    $routes->post('cuti/store', 'CutiController::store');
    $routes->get('cuti/detail/(:num)', 'CutiController::detail/$1');

    $routes->get('profil', 'ProfilController::index');
    $routes->post('profil/update', 'ProfilController::update');
    $routes->post('profil/ganti-password', 'ProfilController::gantiPassword');
});