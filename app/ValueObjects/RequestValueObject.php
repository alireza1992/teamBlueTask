<?php

namespace App\ValueObjects;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class RequestValueObject
{

    private array $inputs;

    /**
     * @param array $inputs
     */
    private function __construct(array $inputs)
    {
        if (count($inputs) < 1) {
            throw new UnprocessableEntityHttpException("There Should be at least 1 field in the request body");
        }
        $this->inputs = $inputs;
    }


    public static function fromRequest(Request $request)
    {
        return new static($request->all());
    }

    /**
     * @return array
     */
    public function getInputs()
    {
        if (count($this->inputs) > 2){
        $this->inputs = Arr::shuffle($this->inputs);
        }
        if (count($this->inputs) === 1) {
            return [array_shift($this->inputs)];
        }
        return [
            array_shift($this->inputs),
            array_shift($this->inputs),
        ];


    }

}
