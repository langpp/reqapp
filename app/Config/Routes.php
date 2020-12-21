<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// * Dashboard
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/home/permintaan-terbanyak', 'Home::getPermintaanTerbanyak');

// * Auth
$routes->get('/login', 'Auth::index');
$routes->post('/auth/auth-check', 'Auth::authCheck');
$routes->get('/logout', 'Auth::logout');

// * POS
$routes->get('/pos', 'POS::index', ['filter' => 'auth_dinas']);
$routes->get('/pos/insert', 'POS::insert');

// * Data Master
$routes->get('/daftar-kebutuhan', 'DaftarKebutuhan::index', ['filter' => 'auth']);
$routes->get('/daftar-kebutuhan/list', 'DaftarKebutuhan::list');
$routes->get('/daftar-kebutuhan/get-data', 'DaftarKebutuhan::getData');
$routes->get('/daftar-kebutuhan/get-by-id', 'DaftarKebutuhan::getByID');
$routes->post('/daftar-kebutuhan/insert', 'DaftarKebutuhan::insert');
$routes->post('/daftar-kebutuhan/edit', 'DaftarKebutuhan::edit');
$routes->post('/daftar-kebutuhan/delete', 'DaftarKebutuhan::delete');
$routes->post('/daftar-kebutuhan/upload', 'DaftarKebutuhan::uploadKebutuhan');

$routes->get('/kategori-kebutuhan', 'KategoriKebutuhan::index', ['filter' => 'auth']);
$routes->get('/kategori-kebutuhan/list', 'KategoriKebutuhan::list');
$routes->get('/kategori-kebutuhan/get-by-id', 'KategoriKebutuhan::getByID');
$routes->post('/kategori-kebutuhan/insert', 'KategoriKebutuhan::insert');
$routes->post('/kategori-kebutuhan/edit', 'KategoriKebutuhan::edit');
$routes->post('/kategori-kebutuhan/delete', 'KategoriKebutuhan::delete');

$routes->get('/riwayat-kebutuhan', 'DaftarRiwayatKebutuhan::index');
$routes->get('/riwayat-kebutuhan/list-riwayat', 'DaftarRiwayatKebutuhan::list');

// * Manajemen User
$routes->get('/manajemen-user', 'ManajemenUser::index', ['filter' => 'auth']);
$routes->get('/manajemen-user/list', 'ManajemenUser::list');
$routes->get('/manajemen-user/get-by-id', 'ManajemenUser::getByID');
$routes->post('/manajemen-user/insert', 'ManajemenUser::insert');
$routes->post('/manajemen-user/edit', 'ManajemenUser::edit');
$routes->post('/manajemen-user/delete', 'ManajemenUser::delete');

// * Data Permintaan
$routes->get('/permintaan-masuk', 'PermintaanMasuk::index', ['filter' => 'auth']);
$routes->get('/permintaan-masuk/list', 'PermintaanMasuk::list');
$routes->get('/permintaan-masuk/detail/(:any)', 'PermintaanMasuk::detail/$1');
$routes->get('/permintaan-masuk/get-by-id', 'PermintaanMasuk::getByID');
$routes->post('/permintaan-masuk/edit', 'PermintaanMasuk::edit');

$routes->get('/permintaan-diproses', 'PermintaanDiproses::index', ['filter' => 'auth']);
$routes->get('/permintaan-diproses/list', 'PermintaanDiproses::list');
$routes->get('/permintaan-diproses/detail/(:any)', 'PermintaanDiproses::detail/$1');

$routes->get('/permintaan-selesai', 'PermintaanSelesai::index', ['filter' => 'auth']);
$routes->get('/permintaan-selesai/list', 'PermintaanSelesai::list');
$routes->get('/permintaan-selesai/detail/(:any)', 'PermintaanSelesai::detail/$1');

$routes->get('/permintaan-ditolak', 'PermintaanDitolak::index', ['filter' => 'auth']);
$routes->get('/permintaan-ditolak/list', 'PermintaanDitolak::list');
$routes->get('/permintaan-ditolak/detail/(:any)', 'PermintaanDitolak::detail/$1');

//  * Detail Transaksi
$routes->get('/detail-transaksi/detail', 'DetailTransaksi::detail');

// * Report
$routes->get('/report', 'reportController::index');
$routes->get('/report/kebutuhan', 'reportController::exportKebutuhan');
$routes->get('/report/kebutuhanhistory', 'reportController::exportKebutuhanHistory');
$routes->get('/report/transaksi', 'reportController::exportTransaksi');
$routes->get('/report/exceltemplate', 'reportController::excelTemplate');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
