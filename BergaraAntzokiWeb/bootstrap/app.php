<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsArrunta;

// Configuración principal de la aplicación Laravel: rutas, middlewares y excepciones.
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
          // Registramos nuestros middlewares con nombres cortos ("admin" y "arrunta") para usarlos en routes/web.php.
          $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
            'arrunta' => EnsureUserIsArrunta::class,
        ]);

        // Saioa hasi gabe erosketa orri batera sartzean, ekitaldiaren orrira bidali (han popup-a dago), ez Breeze-ren login orrira.
        $middleware->redirectGuestsTo(fn (Request $request) => $request->route('ekitaldia')
            ? route('ekitaldiak.show', $request->route('ekitaldia'))
            : route('welcome'));
    })
    // Si la petición es de API o espera JSON, los errores se devuelven en formato JSON.
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
