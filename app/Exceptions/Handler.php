<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
     * @param  \Exception $exception
     * @return void
     * @throws Exception
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
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        $code = 400;
        $error = 'Request Failed';

        if ($exception instanceof ValidationException) {

            $errors = [];

            foreach ($exception->errors() as $errorArray) {
                foreach ($errorArray as $error) {
                    $errors[] = $error;
                }
            }

            return new JsonResponse(['data' => [], 'errors' => $errors, 'message' => 'Validation errors'], 422);
        }

        if ($exception instanceof UnauthorizedHttpException ||  $exception instanceof ModelNotFoundException) {
            $className = explode('\\', get_class($exception));

            switch (end($className)) {
                case 'UnauthorizedHttpException':
                    $code = 401;
                    $error = 'Unauthorized';
                    break;
                case 'ModelNotFoundException':
                    $code = 404;
                    $error = 'No record found';
                    break;
            }

            return new JsonResponse(['data' => [], 'errors' => [$error], 'message' => 'Restricted'], $code);
        }


        return parent::render($request, $exception);
    }
}
