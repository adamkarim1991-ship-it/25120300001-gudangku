<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// KONFIGURASI KHUSUS UNTUK VERCEL (Hanya berjalan di Linux/Server)
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    // Abaikan jika berjalan di Windows (laptop Anda)
} else {
    // Paksa penulisan ke /tmp jika berjalan di Vercel (Linux)
    $_ENV['SESSION_DRIVER'] = 'cookie';
    $_ENV['CACHE_STORE'] = 'array';
    $_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
    $_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';
    $_ENV['APP_EVENTS_CACHE'] = '/tmp/events.php';
    $_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
    $_ENV['APP_SERVICES_CACHE'] = '/tmp/services.php';
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp';
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();