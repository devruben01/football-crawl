<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;


class Handler extends ExceptionHandler
{
    use ResponseTrait;

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

    public function render($request, Throwable $e)
    {
        if (
            $e instanceof ValidationException || $e->getCode() == ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
        ) {
            return $this->responseValidationFailed($e->getMessage());
        }

        if ($e instanceof NotFoundHttpException || $e->getCode() == ResponseAlias::HTTP_NOT_FOUND) {
            return $this->responseNotFound();
        }

        if ($e instanceof UnauthorizedException || $e->getCode() == ResponseAlias::HTTP_FORBIDDEN) {
            return $this->responseUnAuthorize();
        }

        if ($e instanceof AuthenticationException || $e->getCode() == ResponseAlias::HTTP_UNAUTHORIZED) {
            return $this->responseUnauthenticated();
        }

        if ($e instanceof ConnectionException || $e->getCode() == ResponseAlias::HTTP_REQUEST_TIMEOUT) {
            return $this->responseRequestTimeout();
        }
        return $this->responseBadRequest();
    }
}
