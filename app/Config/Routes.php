<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Web::index');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/message', 'MessageController::message');
$routes->get('messages/detail/(:num)', 'MessageController::detail/$1');
$routes->get('/messages/reply/(:num)', 'MessageController::reply/$1');
// $routes->post('messages/delete/(:num)', 'MessageController::delete/$1');
$routes->get('messages/delete/(:num)', 'MessageController::delete/$1');
// $routes->get('profile', 'ProfileController::index');
// $routes->post('profile/update', 'ProfileController::update');

// $routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);

// $routes->get('profile', 'ProfileController::index');
// $routes->post('profile/update', 'ProfileController::update');






$routes->get('/test', 'MessageController::test');
// $routes->get('/new', 'MessageController::newMessage');

// pesan baru
$routes->get('/messages/new', 'MessageController::newMessage');
$routes->post('/messages/send', 'MessageController::send');
$routes->get('/messages/drafts', 'MessageController::drafts');


$routes->get('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');


$routes->setDefaultController('Web');
$routes->setDefaultMethod('index');
$routes->setAutoRoute(true);

// $routes->group('profile', ['filter' => 'auth'], function($routes) {
//     $routes->get('/', 'ProfileController::index');
//     $routes->post('update', 'ProfileController::update');
// });


// manageuser
$routes->get('/manage_users', 'UserManagement::index');

$routes->get('/manage_users/create', 'UserManagement::create');
$routes->post('/manage_users/store', 'UserManagement::store');
$routes->add('/manage_users/edit/(:num)', 'UserManagement::ubah/$1');
$routes->post('/manage_users/update/(:num)', 'UserManagement::update/$1');
$routes->get('/manage_users/delete/(:num)', 'UserManagement::delete/$1');

$routes->post('/profile/update/(:num)', 'UserManagement::update/$1');

$routes->get('/contacts', 'MessageController::contact');
$routes->post('/contacts/store', 'MessageController::tambahcontact');



// profile
// Route untuk menampilkan halaman profile
// $routes->get('/profile', 'UserManagement::profile');

// Route untuk meng-update profile
$routes->post('/profile/update', 'UserManagement::updateProfile');
$routes->get('UserManagement/getUserData', 'UserManagement::getUserData');
$routes->get('profile/getUserData', 'UserManagement::getUserData');


// Halaman Lupa Password
$routes->get('/lupa_password', 'Auth::lupa_password');
$routes->post('auth/send_reset_link', 'Auth::send_reset_link'); // Mengirim link reset password
$routes->get('auth/reset_password/(:any)', 'Auth::reset_password/$1'); // Halaman untuk mengatur ulang password
$routes->post('auth/update_password', 'Auth::update_password'); // Proses mengatur ulang password


$routes->get('/profile/update', 'UserManagement::ubah');


$routes->get('/home-pelanggan', 'Home::homePelanggan');

$routes->get('deposit', 'DepositController::deposit');
$routes->post('deposit/submit', 'DepositController::submit');
$routes->get('deposit/success', 'DepositController::success');
$routes->get('transaksi', 'TransactionController::index');
// $routes->post('deposit/submit', 'TransactionController::submit');


$routes->group('admin', ['filter' => 'filteradmin'], function ($routes) {
    $routes->get('deposit', 'Admin\DepositController::index');
    $routes->get('deposit/update/(:num)', 'Admin\DepositController::update/$1');
    $routes->get('deposit/delete/(:num)', 'Admin\DepositController::delete/$1');
    $routes->get('deposit/reject/(:num)', 'Admin\DepositController::reject/$1');
    $routes->post('deposit/reject/(:num)', 'Admin\DepositController::reject/$1');
    $routes->post('deposit/mass_action', 'Admin\DepositController::mass_action');
});


