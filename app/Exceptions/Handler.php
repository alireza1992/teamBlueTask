<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\{MethodNotAllowedHttpException,
    NotFoundHttpException,
    UnprocessableEntityHttpException
};
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Exception|Throwable $e): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        $status = 500;
        $title = 'General error';
        $detail = 'Sorry, something on the server side happened now';

        switch ($e) {
            case ($e instanceof NotFoundHttpException):
                $status = 404;
                $title = 'The requested resource has not been found';
                $detail = '';
                break;
            case ($e instanceof MethodNotAllowedHttpException):
                $status = 405;
                $title = "Method not allowed exception";
                $detail = "The HTTP method '{$request->getMethod()}' is not allowed here";
                break;
            case ($e instanceof UnprocessableEntityHttpException):
                $status = 422;
                $title = "Unprocessable Entity";
                $detail = "Its either you have not send at least one input or there is an unknown scenario";
                break;
        }

        return response()->json([
            'errors' => [
                [
                    'status' => $status,
                    'source' => ['pointer' => $request->getUri()],
                    'title' => $title,
                    'detail' => $detail
                ]
            ]
        ], $status);

    }

}
