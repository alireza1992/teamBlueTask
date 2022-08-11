<?php

namespace App\Services\Parser\Components;


class PrintOutput implements RequestProcessorInterface
{


    /**
     * @param $inputs
     * @return bool
     */
    public function isApplicable($inputs): bool
    {
        if (count($inputs) === 1) {
            return true;
        }
        return false;

    }

    /**
     * @param $inputs
     * @return mixed
     */
    public function getResult($inputs): array
    {
        return $inputs;
    }
}
