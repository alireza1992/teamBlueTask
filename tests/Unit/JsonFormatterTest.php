<?php

namespace Tests\Unit;


use App\Services\Parser\Components\{EmojiOutput,
    PrintOutput,
    StringConcatenation,
    SumOfNumbers
};

use Tests\TestCase;


class JsonFormatterTest extends TestCase
{

    public function test_sum_of_two_numbers()
    {
        $request = [
            1, 2
        ];
        $sumClass = new SumOfNumbers();
        $this->assertEquals([3], $sumClass->getResult($request));
    }

    public function test_emoji_detector()
    {
        $request = [
            "😂"
        ];
        $emoji = new EmojiOutput();
        $this->assertEquals(["😂"], $emoji->getResult($request));
    }

    public function test_concatenate_string()
    {
        $request = [
            "jimmy", " jackson"
        ];
        $stringConcatenator = new StringConcatenation();
        $this->assertEquals(["jimmy jackson"], $stringConcatenator->getResult($request));
    }


    public function test_one_input_return()
    {
        $request = [
            "jimmy"
        ];
        $printOutput = new PrintOutput();
        $this->assertEquals(["jimmy"], $printOutput->getResult($request));
    }

}
