<?php

namespace App\Services\Parser;

use App\Services\Parser\Components\RequestProcessorInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ParserService
{
    /**
     * @var RequestProcessorInterface[] $parsers
     *
     */
    private iterable $parsers;

    public function __construct(iterable $parsers)
    {
        $this->parsers = $parsers;
    }

    /**
     * @param $inputs
     * @return array
     */
    public function getResult($inputs): array
    {
        foreach ($this->parsers as $parser) {
            if ($parser->isApplicable($inputs)){
                return $parser->getResult($inputs);
            }
        }
        throw new UnprocessableEntityHttpException("Other scenarios");
    }

}
