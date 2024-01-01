<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfirmRouteTest extends TestCase
{
    public function test_method_not_allowed_when_method_is_get(): void
    {
        $response = $this->get('/contacts/confirm');
        $response->assertMethodNotAllowed();
    }

    public function test_invalid_when_params_are_empty(): void
    {
        $response = $this->post('/contacts/confirm');
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }

    public function test_only_name_is_valid(): void
    {
        $params = [
            'name' => 'a',
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertValid(['name']);
        $response->assertInvalid(['email', 'tel']);
    }

    public function test_only_email_is_valid(): void
    {
        $params = [
            'email' => 'a@a',
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertValid(['email']);
        $response->assertInvalid(['name', 'tel']);
    }

    public function test_only_tel_is_valid_when_tel_is_10_digits(): void
    {
        $params = [
            'tel' => str_repeat('0', 10),
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertValid(['tel']);
        $response->assertInvalid(['name', 'email']);
    }

    public function test_only_tel_is_valid_when_tel_is_11_digits(): void
    {
        $params = [
            'tel' => str_repeat('0', 11),
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertValid(['tel']);
        $response->assertInvalid(['name', 'email']);
    }

    public function test_invalid_when_name_is_too_long(): void
    {
        $params = [
            'name' => str_repeat('a', 256),
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }

    public function test_invalid_when_email_is_not_email(): void
    {
        $params = [
            'email' => 'a',
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }

    public function test_invalid_when_email_is_too_long(): void
    {
        $params = [
            'email' => str_repeat('a', 254) . '@a',
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }

    public function test_invalid_when_tel_is_not_numeric(): void
    {
        $params = [
            'tel' => 'a',
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }

    public function test_invalid_when_tel_is_too_short(): void
    {
        $params = [
            'tel' => str_repeat('0', 9),
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }

    public function test_invalid_when_tel_is_too_long(): void
    {
        $params = [
            'tel' => str_repeat('0', 12),
        ];
        $response = $this->post('/contacts/confirm', $params);
        $response->assertRedirect('/');
        $response->assertInvalid(['name', 'email', 'tel']);
    }
}
