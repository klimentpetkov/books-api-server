<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Intervention\Image\Exception\ImageException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Windwalker\Structure\Format;

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
                $message = $e->getMessage();
                return response()->view('errors.method-not-allowed', compact('message'));
                break;
            case ($e instanceof NotFoundHttpException):
            case ($e instanceof RouteNotFoundException):
                $message =  'Such route ' . $request->getRequestUri() . ' do not exist!';
                return response()->view('errors.route-not-found', compact('message'));
                break;
            case ($e instanceof ImageException):
                return response()->view('errors.image');
                break;
            default:
                return parent::render($request, $e);
        }
    }
}
