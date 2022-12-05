<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Cors;
use App\Filters\APIv1\BasicAuthAdmin;
use App\Filters\APIv1\BasicAuthUsers;
use App\Filters\APIv3\TokenAuthAdmin;
use App\Filters\APIv3\TokenAuthUsers;
use App\Filters\APIv4\APIKeyAuth;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'basicAuthAdmin'     => BasicAuthAdmin::class,
        'basicAuthUsers'     => BasicAuthUsers::class,
        'tokenAuthAdmin'     => TokenAuthAdmin::class,
        'tokenAuthUsers'     => TokenAuthUsers::class,
        'apikey'        => APIKeyAuth::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'cors',
            //'basicAuth'
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
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
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [
    ];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'basicAuthAdmin' => ['before' => ['APIv1/ventas/modificarCantidadVenta/*','APIv1/ventas/eliminarRegistroVenta/*']],
        'basicAuthUsers' => ['before' => ['APIv1/ventas/*'], 'except' => ['APIv1/ventas/register', 'APIv1/ventas/login']],

        'tokenAuthAdmin' => ['before' => ['APIv3/ventas/modificarCantidadVenta/*','APIv3/ventas/eliminarRegistroVenta/*']],
        'tokenAuthUsers' => ['before' => ['APIv3/ventas/*'], 'except' => ['APIv3/ventas/register', 'APIv3/ventas/login']],

        'apikey' => ['before' => ['APIv4/ventas/*'], 'except' => ['APIv4/ventas/register', 'APIv4/ventas/login']]
    ];
}
