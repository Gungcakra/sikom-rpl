<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Jika exception adalah HTTP Exception (seperti 404, 403, dll)
        if ($exception instanceof HttpExceptionInterface) {
            $status = $exception->getStatusCode();

            // Jika view error tersedia, tampilkan
            if (view()->exists("errors.{$status}")) {
                return response()->view("errors.{$status}", [], $status);
            }
        }

        // Jika bukan HTTP exception, kita anggap 500
        if (view()->exists('errors.500')) {
            return response()->view('errors.500', [], 500);
        }

        // Fallback ke default Laravel handler
        return parent::render($request, $exception);
    }
}
