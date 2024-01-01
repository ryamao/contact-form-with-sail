<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestData;

class StoreRouteTest extends TestCase
{
    use DatabaseMigrations;

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

    public function test_stores_request_params_to_database(): void
    {
        foreach (TestData::makeValidParamsList() as $params) {
            $this->post('/contacts', $params);
        }

        foreach (TestData::makeValidParamsList() as $i => $params) {
            $model = Contact::find($i + 1);
            $this->assertEquals($params['name'], $model->name);
            $this->assertEquals($params['email'], $model->email);
            $this->assertEquals($params['tel'], $model->tel);
            $this->assertEquals(trim($params['content']), trim($model->content));
        }
    }
}
