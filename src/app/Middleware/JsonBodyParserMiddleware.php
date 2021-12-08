<?php

namespace App\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Handlers\Strategies\RequestHandler;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class JsonBodyParserMiddleware implements MiddlewareInterface
{
    public function process($request, $handler): ResponseInterface
    {
        $contentType = $request->getHeaderLine('Content-Type');

        if (strpos($contentType, 'application/json') !== false) {
            try {
                $contents = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
                $request = $request->withParsedBody($contents);
            } catch (\JsonException $e) {
                return new Response(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY);
            }
        }

        return $handler->handle($request);
    }
}
