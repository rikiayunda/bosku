<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/pesan', 'Web::index');
$routes->get('/', 'Web::utama');
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
$routes->get('/profile', 'UserManagement::profile');

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
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'filteradmin'], function ($routes) {
    $routes->get('products', 'ProductsController::index');
    $routes->get('products/create', 'ProductsController::create'); // Halaman tambah produk
    $routes->post('products/store', 'ProductsController::store'); // Menyimpan produk baru
    $routes->get('products/edit/(:num)', 'ProductsController::edit/$1'); // Halaman edit produk
    $routes->post('products/update/(:num)', 'ProductsController::update/$1'); // Proses update produk
    $routes->get('products/delete/(:num)', 'ProductsController::delete/$1'); // Hapus produk
});
// $routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
//     $routes->get('products', 'ProductsController::index'); 
// });




$routes->get('admin/bank', 'BankController::index');
$routes->get('admin/bank/create', 'BankController::create');
$routes->post('admin/bank/store', 'BankController::store');
$routes->get('admin/bank/delete/(:num)', 'BankController::delete/$1');


// $routes->get('checkout', 'Checkout::index'); 
$routes->get('checkout/(:num)', 'Checkout::index/$1');

// $routes->get('checkout/(:num)', 'Checkout::index/$1', ['filter' => 'none']);

// $routes->get('checkout/(:segment)', 'Checkout::index/$1');
// $routes->post('/checkout/process', 'Checkout::process');
$routes->post('checkout/process', 'Checkout::process');

$routes->post('/checkout/upload-payment', 'Checkout::uploadPayment');
$routes->get('/checkout/invoice/(:num)', 'Checkout::invoice/$1');
$routes->get('checkout/invoice/(:num)', 'Checkout::invoice/$1');
$routes->get('checkout/invoice/download/(:num)', 'Checkout::downloadInvoice/$1');


$routes->get('/admin/orders', 'AdminController::orders');
$routes->get('/admin/approve-order/(:num)', 'AdminController::approveOrder/$1');
$routes->post('admin/delete-order/(:num)', 'AdminController::deleteOrder/$1');
$routes->post('admin/delete-all-orders', 'AdminController::deleteAllOrders');


// $routes->post('admin/delete-order/(:num)', 'AdminController::deleteOrder/$1');  
$routes->post('admin/bulk-action', 'AdminController::bulkAction');


$routes->get('admin/edit-saldo/(:num)', 'AdminController::editSaldo/$1');
$routes->post('admin/update-saldo', 'AdminController::updateSaldo');
$routes->post('admin/reset-saldo', 'AdminController::resetSaldo');


$routes->get('admin/change-password/(:num)', 'AdminController::changePassword/$1');
$routes->post('admin/update-password', 'AdminController::updatePassword');


$routes->get('/withdrawal', 'WithdrawalController::index');
$routes->post('/withdrawal/store', 'WithdrawalController::store');

// $routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'filteradmin'], function ($routes) {
    $routes->get('/admin/withdrawals', 'admin\WithdrawalController::index');
    $routes->get('/admin/withdrawals/approve/(:num)', 'admin\WithdrawalController::approve/$1');
    $routes->post('/admin/withdrawals/uploadProof/(:num)', 'admin\WithdrawalController::uploadProof/$1');
    $routes->get('/admin/withdrawals/delete/(:num)', 'admin\WithdrawalController::delete/$1');


    // $routes->group('referral', function ($routes) {
        $routes->get('/referral', 'ReferralController::index');               // Menampilkan halaman Referral & Bonus
        $routes->post('/send-invite', 'ReferralController::sendInvite'); // Mengirim undangan referral
        $routes->post('/update-bonus', 'ReferralController::updateBonus'); // Memperbarui bonus komisi
    // });
    

    $routes->get('/panduan-faq', 'FaqController::index');

    $routes->get('/support-bantuan', 'SupportController::index');

