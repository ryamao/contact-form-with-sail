<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexPageTest extends TestCase
{
    public function test_index_page_returns_status_ok(): void
    {
        $response = $this->get('/');
        $response->assertOk();
    }
}
