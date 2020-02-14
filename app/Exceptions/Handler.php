<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Traits\ResponseBuilder;
use Illuminate\Http\JsonResponse;
class Handler extends ExceptionHandler
{
    use ResponseBuilder;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof HttpException){

            $code = $exception->getStatusCode();
            $message = JsonResponse::$statusTexts[$code];

            return $this->errorResponse($message, $code);
        }

        if($exception instanceof ModelNotFoundException){

            $model = strtolower(class_basename($exception->getModel()));
            
            return $this->errorResponse("Instance of {$model} with the given id does not exist", JsonResponse::HTTP_NOT_FOUND);
        }

        if($exception instanceof AuthorizationException){
 
            return $this->errorResponse($exception->getMessage(), JsonResponse::HTTP_FORBIDDEN);
        }


        if($exception instanceof AuthenticationException){
 
            return $this->errorResponse($exception->getMessage(), JsonResponse::HTTP_UNAUTHORISED);
        }

        if($exception instanceof ValidationException){
 
            return $this->errorResponse($exception->validator->errors()->getMessages(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(!env('APP_DEBUG',false)){

            return $this->errorResponse('Unexpected error. Try Later', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            
        }

        return parent::render($request, $exception);
    }
}
