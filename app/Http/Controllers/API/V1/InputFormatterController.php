<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\Parser\ParserService;
use App\ValueObjects\RequestValueObject;
use Illuminate\Http\{JsonResponse,
                    Request};

class InputFormatterController extends Controller
{
    /**
     * @param Request $request
     * @param ParserService $parserService
     * @return JsonResponse
     */
    public function jsonFormatter(Request $request,ParserService $parserService): JsonResponse
    {

        $inputs = RequestValueObject::fromRequest($request)->getInputs();
        $result =  $parserService->getResult($inputs);
        return response()->json([
            "data"=>[
                "inputs"=>$inputs,
                "result"=>$result
            ]
        ]);
    }
}
