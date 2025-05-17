<?php

use App\Http\Middleware\CheckAge;
use App\Http\Middleware\LogRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(CheckAge::class);
        // $middleware->append(LogRequest::class);
        //middleware groupe
        // $middleware->appendToGroup('groupMiddle',[
        //     (CheckAge::class),
        //     (LogRequest::class),
        // ]);

        $middleware->alias([
            'age'=>CheckAge::class,
            'log'=>LogRequest::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
