<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/peta', 'Home::peta', ['as' => 'peta']);
$routes->get('/cari',        'Home::cari',       ['as' => 'cari']);
$routes->post('/cari/filter', 'Home::cariFilter', ['as' => 'cari.filter']); // AJAX endpoint
$routes->get('/bandingkan', 'Home::bandingkan', ['as' => 'bandingkan']);
$routes->get('/sekolah/(:segment)', 'Home::sekolah/$1', ['as' => 'sekolah']);

service('auth')->routes($routes);

$routes->group('admin', ['filter' => 'session'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index', ['as' => 'admin.dashboard']);
});

$routes->group('admin', ['filter' => 'group:superadmin'], function ($routes) {
    $routes->get('sekolah', 'Admin\SekolahController::index', ['as' => 'admin.sekolah']);
    $routes->get('sekolah/data',         'Admin\SekolahController::getData', ['as' => 'admin.sekolah.data']);
    $routes->get('sekolah/create', 'Admin\SekolahController::create', ['as' => 'admin.sekolah.create']);
    $routes->post('sekolah/store', 'Admin\SekolahController::store', ['as' => 'admin.sekolah.store']);
    $routes->post('sekolah/import', 'Admin\SekolahController::importStore', ['as' => 'admin.sekolah.import.store']);

    // routes.php — sesuaikan jika berbeda
    $routes->get('sekolah/(:segment)/detail', 'Admin\SekolahController::show/$1',   ['as' => 'admin.sekolah.show']);
    $routes->get('sekolah/(:segment)/edit', 'Admin\SekolahController::edit/$1', ['as' => 'admin.sekolah.edit']);
    $routes->post('sekolah/(:segment)/edit', 'Admin\SekolahController::update/$1', ['as' => 'admin.sekolah.update']);
    $routes->post('sekolah/(:segment)/delete', 'Admin\SekolahController::delete/$1', ['as' => 'admin.sekolah.delete']);
    // Tambahkan rute admin lainnya di siniz


    // jenis fasilitas
    $routes->get('jenis_fasilitas', 'Admin\JenisFasilitasController::index', ['as' => 'admin.jenis_fasilitas']);
    $routes->get('jenis_fasilitas/data', 'Admin\JenisFasilitasController::getData', ['as' => 'admin.jenis_fasilitas.data']);
    $routes->post('jenis_fasilitas/store', 'Admin\JenisFasilitasController::store', ['as' => 'admin.jenis_fasilitas.store']);
    $routes->post('jenis_fasilitas/(:segment)/delete', 'Admin\\JenisFasilitasController::delete/$1', ['as' => 'admin.jenis_fasilitas.delete']);
    $routes->post('jenis_fasilitas/(:segment)/update', 'Admin\\JenisFasilitasController::update/$1', ['as' => 'admin.jenis_fasilitas.update']);

    // user
    $routes->get('user', 'Admin\UserController::index', ['as' => 'admin.user']);
    $routes->get('user/create', 'Admin\UserController::create', ['as' => 'admin.user.create']);
    $routes->get('user/data', 'Admin\UserController::getData', ['as' => 'admin.user.data']);
    $routes->post('user/store', 'Admin\UserController::store', ['as' => 'admin.user.store']);
    $routes->get('user/(:segment)/edit', 'Admin\UserController::edit/$1', ['as' => 'admin.user.edit']);
    $routes->post('user/(:segment)/update', 'Admin\\UserController::update/$1', ['as' => 'admin.user.update']);
    $routes->post('user/(:segment)/reset-default', 'Admin\\UserController::resetToDefault', ['as' => 'admin.user.resetDefault']);
    $routes->post('user/(:segment)/delete', 'Admin\\UserController::delete/$1', ['as' => 'admin.user.delete']);

    // wilayah
    $routes->get('wilayah', 'Admin\WilayahController::index', ['as' => 'admin.wilayah']);
    $routes->post('wilayah/store', 'Admin\WilayahController::store', ['as' => 'admin.wilayah.store']);
    $routes->post('wilayah/(:segment)/delete', 'Admin\\WilayahController::delete/$1', ['as' => 'admin.wilayah.delete']);
    $routes->post('wilayah/(:segment)/update', 'Admin\\WilayahController::update/$1', ['as' => 'admin.wilayah.update']);

    // baris ini sudah tidak dipakai, bisa dihapus:
    // $routes->get('wilayah/data', ...);
    // $routes->get('wilayah/options', ...);
});
