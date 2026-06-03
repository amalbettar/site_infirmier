<?php

use App\Http\Middleware\AdminMidlleware;
use App\Http\Middleware\InfirmierMiddleware;
use App\Http\Middleware\PatientMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin'=>AdminMidlleware::class,
            'infirmier'=>InfirmierMiddleware::class,
            'patient'=>PatientMiddleware::class,
            
        ]);
        $middleware->web(append: [
            SetLocale::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
