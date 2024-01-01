<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestData;

class StoreRouteTest extends TestCase
{
    public function test_status_is_method_not_allowed_when_method_is_get(): void
    {
        $response = $this->get('/contacts');
        $response->assertMethodNotAllowed();
    }

    public function test_redirects_to_index_page_when_parameters_are_empty(): void
    {
        $response = $this->post('/contacts');
        $response->assertRedirect('/');
        $response->assertValid();
    }

    public function test_status_is_ok_when_post_with_valid_params(): void
    {
        foreach (TestData::makeValidParamsList() as $params) {
            $response = $this->post('/contacts', $params);
            $response->assertOk();
            $response->assertValid();
        }
    }
}
