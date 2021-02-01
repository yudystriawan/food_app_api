<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Http\Client\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($e, $request);
        });
    }

    public function handleException(Exception $exception, $request)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof NotFoundHttpException) {
            $e = $exception->getPrevious();

            if ($e instanceof ModelNotFoundException) {
                $modelName = strtolower(class_basename($e->getModel()));
                return $this->errorResponse("Does not exist any {$modelName} with the specific indentificator", 404);
            }
    
            return $this->errorResponse("The specified URL cannot be found", 404);

        }

        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse('Unauthenticated', 401);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(), 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('The specified method for the request is invalid', 404);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getCode());
        }

        if ($exception instanceof QueryException) {
            $errorCode = $exception->errorInfo[1];

            if ($errorCode == 1451) {
                return $this->errorResponse('Cannot remove this resource permanently. It is related with any other resource.', 409);
            }
        }

        if (config('app.debug'))
        {
            return $this->prepareResponse($request, $exception);
        }

        return $this->errorResponse('Something went wrong', 500);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        // if ($e->response) {
        //     return $e->response;
        // }

        // return $request->expectsJson()
        //             ? $this->invalidJson($request, $e)
        //             : $this->invalid($request, $e);

        $errors = $e->validator->errors()->getMessages();
        $code = $e->status;

        return $this->errorResponse($errors, $code);
    }
}
