<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexRouteTest extends TestCase
{
    public function test_returns_ok_when_method_is_get(): void
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function test_response_is_valid(): void
    {
        $response = $this->get('/');
        $response->assertValid();
    }

    public function test_method_not_allowed_when_method_is_post(): void
    {
        $response = $this->post('/');
        $response->assertMethodNotAllowed();
    }
}
