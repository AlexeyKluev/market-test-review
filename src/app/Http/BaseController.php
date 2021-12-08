<?php

namespace App\Http;

use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Response;

abstract class BaseController
{
    /**
     * @param Response $response
     * @param int $statusCode
     * @param string $data
     * @return Response
     */
    protected function error(
        Response $response,
        int      $statusCode = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
        string   $data = '1234'
    ): Response
    {
        $response = $response->withStatus($statusCode);
        $response->getBody()->write($data);
        return $response;
    }

    /**
     * @param Response $response
     * @param int $statusCode
     * @param string $data
     * @return Response
     */
    protected function success(
        Response $response,
        int      $statusCode = StatusCodeInterface::STATUS_OK,
        string   $data = ''
    ): Response
    {
        $response = $response->withStatus($statusCode);
        $response->getBody()->write($data);
        return $response;
    }
}
