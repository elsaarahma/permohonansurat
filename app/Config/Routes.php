<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
//login,logout dan forgot
$routes->get('/login','Auth::index');
$routes->post('/login_process','Auth::login_process');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register','Auth::register');
$routes->post('/register_process','Auth::register_process');
$routes->get('/forgot_pass','Auth::forgot_pass');
//dashboard
$routes->get('/dashboard', 'Auth::dashboard');
//kategori
$routes->get('/kategori','Kategori::index');
$routes->post('/kategori/Kategori/addData','Kategori::addData');
$routes->post('/kategori/Kategori/edit','Kategori::edit');
$routes->delete('kategori/delete/(:num)', 'Kategori::deleteData/$1'); 
$routes->get('/kategori/search', 'Kategori::search');
// rekapan
$routes->get('/rekapan','Rekapan::index');
$routes->get('/laporan','Laporan::index');
$routes->get('entries/load_entries/(:num)', 'EntriesController::load_entries/$1');

//list permohonan
$routes->get('/permohonan_pending','Permohonan::index');
$routes->get('pemohonan_disetujui', 'Permohonan::disetujui');
$routes->get('permohonan_dibatalkan', 'Permohonan::dibatalkan');
$routes->get('permohonan/hapus/(:segment)/(:num)', 'Permohonan::hapusData/$1/$2');
$routes->get('permohonan/hapus/(:segment)/(:num)', 'Permohonan::hapus/$1/$2');
$routes->get('permohonan/delete/(:segment)/(:num)', 'Permohonan::delete/$1/$2');


//form ktp
$routes->get('/dataktp','Dataktp::index');
$routes->get('/ktp','Ktp::index');
$routes->post('Ktp/addData', 'Ktp::addData');
$routes->post('ktp/edit/(:num)', 'Ktp::edit/$1');
$routes->delete('ktp/delete/(:num)', 'Ktp::deleteData/$1'); 
$routes->get('/laporanktp','Laporanktp::index');
$routes->match(['get', 'post'], 'laporanktp', 'Laporanktp::index');


//form kk
$routes->get('/datakk','Datakk::index');
$routes->get('/kk','Kk::index');
$routes->post('Kk/addData', 'Kk::addData');
$routes->post('kk/edit/(:num)', 'Kk::edit/$1');
$routes->delete('kk/delete/(:num)', 'Kk::deleteData/$1'); 
$routes->get('/laporankk','Laporankk::index');
$routes->match(['get', 'post'], 'laporankk', 'Laporankk::index');

//form ahli waris
$routes->get('/ahliwaris','Ahliwaris::index');
$routes->get('/datawarisan','Datawarisan::index');
$routes->post('Ahliwaris/addData', 'Ahliwaris::addData');
$routes->post('ahliwaris/edit/(:num)', 'Ahliwaris::edit/$1');
$routes->delete('ahliwaris/delete/(:num)', 'Ahliwaris::deleteData/$1'); 
$routes->get('/laporanwarisan','Laporanwarisan::index');
$routes->match(['get', 'post'], 'laporanwarisan', 'Laporanwarisan::index');

//form keterangan tanah
$routes->get('/kettanah','Kettanah::index');
$routes->get('datatanah','Datatanah::index');
$routes->post('Kettanah/addData', 'Kettanah::addData');
$routes->post('pindah/edit/(:num)', 'Pindah::edit/$1');
$routes->delete('pindah/delete/(:num)', 'Pindah::deleteData/$1'); 
$routes->get('/laporantanah','Laporantanah::index');
$routes->match(['get', 'post'], 'laporantanah', 'Laporantanah::index');

//form pindah keluar
$routes->get('/pindah','Pindah::index');
$routes->get('/datapindah','Datapindah::index');
$routes->post('Pindah/addData', 'Pindah::addData');
$routes->post('pindah/edit/(:num)', 'Pindah::edit/$1');
$routes->delete('pindah/delete/(:num)', 'Pindah::deleteData/$1');
$routes->get('/laporanpindah','Laporanpindah::index');
$routes->match(['get', 'post'], 'laporanpindah', 'Laporanpindah::index');
//form pindah domisili
$routes->get('/domisili','Domisili::index');
$routes->get('/datadomisili','Datadomisili::index');
$routes->post('Domisili/addData', 'Domisili::addData');
$routes->post('domisili/edit/(:num)', 'Domisili::edit/$1');
$routes->delete('domisili/delete/(:num)', 'Domisili::deleteData/$1'); 
$routes->get('/Laporandomisili','Laporandomisili::index');
$routes->match(['get', 'post'], 'laporandomisili', 'Laporandomisili::index');

$routes->get('permohonan', 'PermohonanSurat::index'); // Misalnya ini adalah route untuk halaman daftar permohonan surat
$routes->get('permohonan/edit/(:num)', 'PermohonanSurat::editStatus/$1'); // Route untuk halaman edit status permohonan surat
$routes->post('permohonan/updateStatus', 'PermohonanSurat::updateStatus'); // Route untuk proses update status permohonan surat;


/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
