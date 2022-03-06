<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic feature test check system alive.
     *
     * @return void
     */
    public function testHealthCheck()
    {
        $response = $this->get('/health-check');

        $response->assertStatus(200);
    }
}
