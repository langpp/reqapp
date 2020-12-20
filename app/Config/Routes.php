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

// * Auth
$routes->get('/login', 'Auth::index');
$routes->post('/auth/auth-check', 'Auth::authCheck');
$routes->get('/logout', 'Auth::logout');

// * POS
$routes->get('/pos', 'POS::index', ['filter' => 'auth_dinas']);

// * Data Master
$routes->get('/daftar-kebutuhan', 'DaftarKebutuhan::index');
$routes->get('/riwayat-kebutuhan', 'DaftarKebutuhan::riwayat');
$routes->get('/daftar-kebutuhan/list', 'DaftarKebutuhan::list');
$routes->get('/daftar-kebutuhan/get-data', 'DaftarKebutuhan::getData');
$routes->get('/daftar-kebutuhan/get-by-id', 'DaftarKebutuhan::getByID');
$routes->post('/daftar-kebutuhan/insert', 'DaftarKebutuhan::insert');
$routes->post('/daftar-kebutuhan/edit', 'DaftarKebutuhan::edit');
$routes->post('/daftar-kebutuhan/delete', 'DaftarKebutuhan::delete');

$routes->get('/kategori-kebutuhan', 'KategoriKebutuhan::index');
$routes->get('/kategori-kebutuhan/list', 'KategoriKebutuhan::list');
$routes->get('/kategori-kebutuhan/get-by-id', 'KategoriKebutuhan::getByID');
$routes->post('/kategori-kebutuhan/insert', 'KategoriKebutuhan::insert');
$routes->post('/kategori-kebutuhan/edit', 'KategoriKebutuhan::edit');
$routes->post('/kategori-kebutuhan/delete', 'KategoriKebutuhan::delete');

// route bawaan gilang
$routes->get('/daftar-kebutuhan/list-riwayat', 'DaftarKebutuhan::listriwayat');
$routes->get('/report', 'gilangController::index');
$routes->get('/report/kebutuhan', 'gilangController::exportkebutuhan');
$routes->get('/report/kebutuhanhistory', 'gilangController::exportkebutuhanhistory');
$routes->get('/report/transaksi', 'gilangController::exporttransaksi');
$routes->get('/report/exceltemplate', 'gilangController::exceltemplate');
$routes->post('/daftar-kebutuhan/upload', 'gilangController::uploadkebutuhan');

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
