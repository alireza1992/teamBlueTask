<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Note : because inputs are unknown (in terms of quantity) and we pick random two, in the tests we have used fake inputs to test the behaviour
 */
class JsonFormatterEndpointTest extends TestCase
{

    public function test_throw_exception_if_both_inputs_missing()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json',
        ])->post('/api/v1/json-output', []);

        $response->assertStatus(422);
    }

    public function test_return_the_input_if_only_one_input_is_provided()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json',
        ])->post('/api/v1/json-output', ['name' => 'Sally']);

        $this->assertEquals(["data" => [
            "inputs" => ["Sally"],
            "result" => ["Sally"]
        ]], $response->json());
    }


    public function test_return_sum_if_both_inputs_are_numbers()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json',
        ])->post('/api/v1/json-output', ['number1' => 12, 'number2' => 4.3]);

        $this->assertEquals(["data" => [
            "inputs" => [12, 4.3],
            "result" => [16.3]
        ]], $response->json());
    }

    public function test_return_concatenate_if_either_inputs_are_string()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json',
        ])->post('/api/v1/json-output', ['number1' => 12, 'name' => "john"]);

        $this->assertEquals(["data" => [
            "inputs" => [12, "john"],
            "result" => ["12john"]
        ]], $response->json());
    }

    public function test_return_emoji_if_either_inputs_are_emoji()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json',
        ])->post('/api/v1/json-output', ['number1' => 12, 'emoji' => "😂"]);

        $this->assertEquals(["data" => [
            "inputs" => [12, "😂"],
            "result" => ["😂"]
        ]], $response->json());
    }


    public function test_http_status_of_the_end_point()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json',
        ])->post('/api/v1/json-output', ['name' => 'Sally']);

        $response->assertStatus(200);
    }


}
