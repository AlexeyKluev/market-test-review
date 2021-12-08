<?php

namespace App\RequestValidators;

use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Valitron\Validator;

class CheckoutRequestValidator
{
    /**
     * @param Request $request
     * @param $handler
     * @return mixed|Response
     */
    public function __invoke(Request $request, $handler)
    {
        $validator = new Validator((array)$request->getParsedBody());
        $validator->rule('required', ['fio', 'phone']);
        if(!$validator->validate()) {
            return new Response(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY); // $validator->errors();
        }

        return $handler->handle($request);
    }
}
