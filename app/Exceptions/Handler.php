<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Intervention\Image\Exception\ImageException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response | \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        switch($e){
            case ($e instanceof MethodNotAllowedHttpException):
                return response()->view('errors.method-not-allowed');
                break;
            case ($e instanceof RouteNotFoundException):
                return response()->view('errors.route-not-found');
                break;
            case ($e instanceof AuthenticationException):
                return response()->view('errors.unauthenticated');
                break;
            case ($e instanceof ImageException):
                return response()->view('errors.image');
                break;
            default:
                return parent::render($request, $e);
        }
    }
}
