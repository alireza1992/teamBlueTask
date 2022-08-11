<?php

namespace App\Services\Parser\Components;

interface RequestProcessorInterface
{
    /**
     * @param $inputs
     * @return bool
     */
    public function isApplicable($inputs): bool;

    /**
     * @param $inputs
     * @return array
     */
    public function getResult($inputs): array;
}
