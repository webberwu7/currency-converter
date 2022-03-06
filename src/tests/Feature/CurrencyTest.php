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

    public function testGetApiCurrenciesConvertTWD()
    {
        // TWD to JPY 基本
        $response = $this->get('/api/currencies/convert?amount=1&from=TWD&to=JPY');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "3.67"
        ]);

        // TWD to JPY 大數
        $response = $this->get('/api/currencies/convert?amount=999999999999999&from=TWD&to=JPY');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "3,668,999,999,999,996.50"
        ]);

        // TWD to USD 基本
        $response = $this->get('/api/currencies/convert?amount=1&from=TWD&to=USD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "0.03"
        ]);

        // TWD to USD 大數
        $response = $this->get('/api/currencies/convert?amount=999999999999999&from=TWD&to=USD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "32,809,999,999,999.96"
        ]);
    }

    public function testGetApiCurrenciesConvertUSD()
    {
        // USD to JPY 基本
        $response = $this->get('/api/currencies/convert?amount=1&from=USD&to=JPY');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "111.80"
        ]);

        // USD to JPY 大數
        $response = $this->get('/api/currencies/convert?amount=999999999999999&from=USD&to=JPY');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "111,800,999,999,999,888.00"
        ]);

        // USD to JPY 小數
        $response = $this->get('/api/currencies/convert?amount=0.01&from=USD&to=JPY');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "1.12"
        ]);

        // USD to TWD 基本
        $response = $this->get('/api/currencies/convert?amount=1&from=USD&to=TWD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "30.44"
        ]);

        // USD to TWD 大數
        $response = $this->get('/api/currencies/convert?amount=999999999999999&from=USD&to=TWD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "30,443,999,999,999,968.00"
        ]);

        // USD to TWD 小數
        $response = $this->get('/api/currencies/convert?amount=0.01&from=USD&to=TWD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "0.30"
        ]);
    }

    public function testGetApiCurrenciesConvertJPY()
    {
        // JPY to TWD 基本
        $response = $this->get('/api/currencies/convert?amount=1&from=JPY&to=TWD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "0.27"
        ]);

        // JPY to TWD 大數
        $response = $this->get('/api/currencies/convert?amount=999999999999999&from=JPY&to=TWD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "269,559,999,999,999.75"
        ]);

        // JPY to USD 基本
        $response = $this->get('/api/currencies/convert?amount=1&from=JPY&to=USD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "0.01"
        ]);

        // JPY to USD 大數
        $response = $this->get('/api/currencies/convert?amount=999999999999999&from=JPY&to=USD');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "source_amount",
            "target_amount",
            "from",
            "to"
        ]);
        $response->assertJson([
            "target_amount" => "8,849,999,999,999.99"
        ]);
    }

    public function testGetApiCurrenciesConvertFail()
    {
        // amount small fail 
        $response = $this->get('/api/currencies/convert?amount=0.001&from=JPY&to=USD');
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "return_message",
        ]);
        $response->assertJson([
            "return_message" => "The amount must be greater than or equal 0.01."
        ]);

        // amount big fail
        $response = $this->get('/api/currencies/convert?amount=99999999999999999&from=JPY&to=USD');
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "return_message",
        ]);
        $response->assertJson([
            "return_message" => "The amount must be less than or equal 10000000000000000."
        ]);

        // currency type fail
        $response = $this->get('/api/currencies/convert?amount=1&from=JPD&to=USD');
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "return_message",
        ]);
        $response->assertJson([
            "return_message" => "The selected from is invalid."
        ]);

        // currency type fail
        $response = $this->get('/api/currencies/convert?amount=1&from=JPY&to=USS');
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "return_message",
        ]);
        $response->assertJson([
            "return_message" => "The selected to is invalid."
        ]);
    }
}
