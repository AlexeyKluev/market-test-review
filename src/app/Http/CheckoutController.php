<?php

namespace App\Http;

use App\Dto\OrderDto;
use App\Model\ProductRepository;
use App\Pipes\CreateOrderPipe;
use App\Pipes\SendSmsPipe;
use Fig\Http\Message\StatusCodeInterface;
use League\Pipeline\Pipeline;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CheckoutController extends BaseController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(CreateOrderPipe $createOrderPipe, SendSmsPipe $sendSmsPipe, Request $request, Response $response)
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();

        $productId = $route->getArgument('id');

        $productCount = $this->productRepository->getAmount($productId);
        if ($productCount <= 0) {
            return $this->error($response, StatusCodeInterface::STATUS_NOT_FOUND, 'error');
        }

        $requestData = (array)$request->getParsedBody();

        $pipeline = (new Pipeline)
            ->pipe($createOrderPipe)
            ->pipe($sendSmsPipe);

        $pipeline->process(new OrderDto(
            $requestData['fio'],
            $requestData['phone'],
            $productId
        ));

        return $this->success($response, StatusCodeInterface::STATUS_OK, 'success');
    }
}
