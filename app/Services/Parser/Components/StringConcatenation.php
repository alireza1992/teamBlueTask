<?php

namespace App\Services\Parser\Components;


class StringConcatenation implements RequestProcessorInterface
{

    /**
     * @param $inputs
     * @return mixed
     */
    public function isApplicable($inputs): bool
    {

        $test = [];
        if (count($inputs) !== 2) {
            return false;
        }

        foreach ($inputs as $input) {

            $test[] = is_string($input);

        }
        return in_array(true, $test);

    }

    /**
     * @param $inputs
     * @return string[]
     */
    public function getResult($inputs): array
    {
        return [join($inputs)];
    }
}
