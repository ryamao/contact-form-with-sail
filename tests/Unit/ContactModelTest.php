<?php

namespace Tests\Unit;

use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\TestData;

class ContactModelTest extends TestCase
{
    use DatabaseMigrations;

    public function test_creation(): void
    {
        foreach (TestData::makeValidParamsList() as $params) {
            Contact::create($params);
        }

        foreach (TestData::makeValidParamsList() as $i => $params) {
            $model = Contact::find($i + 1);
            $this->assertEquals($params['name'], $model->name);
            $this->assertEquals($params['email'], $model->email);
            $this->assertEquals($params['tel'], $model->tel);
            $this->assertEquals($params['content'], $model->content);
        }
    }
}
