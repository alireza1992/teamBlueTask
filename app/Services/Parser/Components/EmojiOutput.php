<?php

namespace App\Services\Parser\Components;


class EmojiOutput implements RequestProcessorInterface
{

    /**
     * @param $inputs
     * @return mixed
     */
    public function isApplicable($inputs): bool
    {
        foreach ($inputs as $input) {
            if ($this->isEmoji($input)) {
                return true;
            }
        }
        return false;

    }

    /**
     * @param $inputs
     * @return mixed
     */
    public function getResult($inputs): array
    {

        $result = [];
        foreach ($inputs as $input) {
            if ($this->isEmoji($input)){
                $result[]=$input;
            }
       }
        return $result;
    }


    private function isEmoji($input): bool
    {
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        return preg_match($regexEmoticons, $input);

    }
}
