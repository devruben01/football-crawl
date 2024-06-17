<?php

namespace App\Traits;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ResponseTrait
{

    /**
     * @param string $message
     * @param $data
     * @return JsonResponse
     */
    public function responseNotFound(
        string $message = Constants::RESOURCE_NOT_FOUND,
        $data = null
    ): JsonResponse {
        return $this->responseCustom(Response::HTTP_NOT_FOUND, $message, $data);
    }

    /**
     * @param string $message
     * @param array $errors
     * @return JsonResponse
     */
    public function responseValidationFailed(string $message = '', array $errors = null): JsonResponse
    {
        return $this->responseCustom($errors, Response::HTTP_UNPROCESSABLE_ENTITY, false, $message);
    }

    /**
     * @return JsonResponse
     */
    public function responseUnauthenticated(): JsonResponse
    {
        return $this->responseCustom(null, Response::HTTP_UNAUTHORIZED, false, 'Unauthorized');
    }

    /**
     * @return JsonResponse
     */
    public function responseUnAuthorize(): JsonResponse
    {
        return $this->responseCustom(null, Response::HTTP_FORBIDDEN, false, trans('response.http_unauthorized'));
    }

    /**
     * @param string $message
     * @param null $data
     * @return JsonResponse
     */
    public function responseBadRequest(
        $data = null,
        string $message = Constants::BAD_REQUEST
    ): JsonResponse {
        return $this->responseCustom($data, Response::HTTP_BAD_REQUEST, false, $message);
    }

    /**
     * @return JsonResponse
     */
    public function responseRequestTimeout(): JsonResponse
    {
        return $this->responseCustom(
            ResponseAlias::HTTP_REQUEST_TIMEOUT,
            false,
            Constants::RESPONSE_SERVER_ERROR,
            ''
        );
    }

    /**
     * @param int $statusCode
     * @param string $message
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    private function responseCustom(
        $data = null,
        int $statusCode = Response::HTTP_OK,
        bool $status = false,
        string $message = '',
        array $headers = [],
    ): JsonResponse {
        $response = [
            'data' => $data,
            'code' => $statusCode,
            'status' => $status,
            'message' => $message,
        ];
        $response = response()->json($response, $statusCode);

        if ($headers) {
            $response->withHeaders($headers);
        }
        return $response;
    }

    private function responseJsonData(
        array | Collection $response = [],
        int $status = Response::HTTP_OK,
        int $result = 0,
        int $totalPage = 1,
        int $currentPage = 1,
        array $errors = [],
        array $headers = [],
    ): JsonResponse {
        $response = [
            'get' => request()->path(),
            'parameters' => request()->all(),
            'errors' => $errors,
            'result' => $result,
            'paging' => [
                'total' => $totalPage,
                'current' => $currentPage,
            ],
            'response' =>  $response,
        ];
        $response = response()->json($response, $status);

        if ($headers) {
            $response->withHeaders($headers);
        }
        return $response;
    }
}
