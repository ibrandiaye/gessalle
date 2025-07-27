<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsFirstConnected;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Middleware\VerifSalle;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
       /* $middleware->use([IsFirstConnected::class,
    IsAdmin::class,IsSuperAdmin::class]);*/
   // $middleware->append([VerifSalle::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
