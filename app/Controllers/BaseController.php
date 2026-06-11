<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // 1. Load Session Service
        $session = \Config\Services::session();
        $language = \Config\Services::language();

        // 2. Cek apakah user sudah punya preferensi bahasa di session?
        $lang = $session->get('lang');

        // 3. Jika ada, set bahasa aplikasi. Jika tidak, default 'id'
        if ($lang) {
            $language->setLocale($lang);
        } else {
            // Default bahasa jika belum memilih
            $language->setLocale('id');
        }
    }
}