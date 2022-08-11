<?php

namespace App\Services\Parser\Components;


class SumOfNumbers implements RequestProcessorInterface
{

    /**
     * @param $inputs
     * @return mixed
     */
    public function isApplicable($inputs): bool
    {

        if (count($inputs) !== 2) {
            return false;
        }
        foreach ($inputs as $input) {
            if (is_string($input) || is_bool($input)) {
                return false;
            }
        }
        return true;

    }

    /**
     * @param $inputs
     * @return array
     */
    public function getResult($inputs): array
    {
        return [array_sum($inputs)];
    }
}
