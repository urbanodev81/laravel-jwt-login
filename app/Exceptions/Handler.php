<?php

namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // ...

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $exception->errors(),
            ], 422);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message' => 'Método não permitido.',
            ], 405);
        }

        if ($exception instanceof HttpException) {
            return response()->json([
                'message' => 'Erro interno do servidor.',
            ], 500);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $exception->errors(),
            ], 400);
        }

        return parent::render($request, $exception);
    }

    // ...
}
