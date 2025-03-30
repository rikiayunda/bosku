<?php

namespace Config;

use App\Filters\AuthFilter;
use App\Filters\FilterAdmin;
use App\Filters\filterpelanggan;
use App\Filters\FilterUser;
use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     *
     * [filter_name => classname]
     * or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'filteradmin'   => FilterAdmin::class,
        'filteruser'   => FilterUser::class,
        'filterpelanggan'   => filterpelanggan::class,
        // 'auth'     => \App\Filters\AuthFilter::class, 
    ];

    // public $aliases =[

    // ];

    /**
     * List of special required filters.
     *
     * The filters listed here are special. They are applied before and after
     * other kinds of filters, and always applied even if a route does not exist.
     *
     * Filters set by default provide framework functionality. If removed,
     * those functions will no longer work.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            'toolbar',     // Debug Toolbar
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            'csrf',
            'filteradmin' =>  ['except' => [
                'auth',
                'auth/*',
                'web',
                'web/*',
                'lupa_password',
                'lupa_password/*',
                'transaksi',
                '/',
            ]],
            'filteruser' =>  ['except' => [
                'auth',
                'auth/*',
                'web',
                'web/*',
                'lupa_password',
                'lupa_password/*',
                '/',
            ]],
            'filterpelanggan' =>  ['except' => [
                'auth',
                'auth/*',
                'web',
                'web/*',
                'lupa_password',
                'lupa_password/*',
                // 'checkout/(:num)',


                '/',

            ]],
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'filteradmin' =>  ['except' => [
                'home',
                'home/*',
                'admin',
                'admin/*',
                'dashboard',
                'dashboard/*',
                'message',
                'message/*',
                'messages/detail/',
                'messages/detail/*',
                '/messages/reply/',
                'messages/reply/*',
                '/messages/new',
                'messages/new*',

                // ManageUser
                '/manage_users',
                '/manage_users*',
                '/manage_users/create',
                '/manage_users/create*',
                '/manage_users/store',
                '/manage_users/store*',
                '/manage_users/edit/(:num)',
                '/manage_users/edit/(:num)*',
                '/manage_users/update/(:num)',
                '/manage_users/update/(:num)*',
                '/manage_users/delete/(:num)',
                '/manage_users/delete/(:num)*',

                // profile
                '/profile',
                '/profile*',
                '/profile/update',
                '/profile/update*',

                //contact
                '/contacts',
                '/contacts/*',
                '/contacts/store',
                '/contacts/store/*',
                'admin/deposit',
                'admin/deposit/*',

                // produk
                'products',
                'products/create',
                'products/store',
                'products/edit/(:num)',
                'products/update/(:num)',
                'products/delete/(:num)',

                //bank
                '/bank',
                '/bank/create',
                '/bank/store',
                '/bank/delete/(:num)',






                // 'profile',  'profile/*',
                //  '/profile/update',  'profile/update/*', 

                'test',
                'test/*',
            ]],
            'filteruser' =>  ['except' => [
                'home',
                'home/*',
                'user',
                'user/*',
                'dashboard',
                'dashboard/*',
                'message',
                'message/*',
                // 'admin', 'admin/*',
            ]],
            'filterpelanggan' =>  ['except' => [
                'home',
                'home/*',
                'pelanggan',
                'pelanggan/*',
                'dashboard',
                'dashboard/*',
                'message',
                'message/*',
                '/home-pelanggan',
                '/home-pelanggan',
                '/deposit',
                '/deposit',
                '/deposit/submit',
                'deposit/submit',
                '/deposit/success',
                'deposit/success',
                '/transaksi',
                'transaksi',
                '/login',
                'login',
                // 'checkout/(:num)',
                'checkout',
                'checkout/*',
                'checkout/(:num)',
                'checkout/process',
                'checkout/upload-payment',
                '/*',


                // Tambahkan akses ke checkout
                // 'checkout/(:num)/*','checkout/(:num)',
                // 'checkout',
                // 'checkout/*',
                // 'checkout/process',
                // 'checkout/upload-payment',

                // 'admin', 'admin/*',
            ]],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'POST' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [
        'csrf' => ['except' => ['admin/deposit/mass_action']],

    ];
}
