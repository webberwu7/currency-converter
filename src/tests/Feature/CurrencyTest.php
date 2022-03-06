<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * A basic feature test check system alive.
     *
     * @return void
     */
    public function testGetApiCurrencies()
    {
        $response = $this->get('/api/currencies');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "currencies" => [
                "TWD" => [
                    "TWD",
                    "JPY",
                    "USD",
                ],
                "JPY" => [
                    "TWD",
                    "JPY",
                    "USD",
                ],
                "USD" => [
                    "TWD",
                    "JPY",
                    "USD",
                ],
            ],
        ]);
    }

    public function testPostApiCurrenciesConvert()
    {
        $response = $this->post('/api/currencies/convert', [
            "amount" => 1,
            "from" => "TWD",
            "to" => "JPY",
        ]);
        
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);

        $response->assertJson([
            "target_amount" => 3.67
        ]);
    }
}
