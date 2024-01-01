<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestData;

class ConfirmPageTest extends DuskTestCase
{
    public function test_page_path_is_contacts_confirm_when_valid_params_are_inputted(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $browser->assertPathIs('/contacts/confirm');
        });
    }

    public function test_confirm_page_title_is_contact_form(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $browser->assertTitle('Contact Form');
        });
    }

    public function test_confirm_page_has_h1_in_header(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $this->assertEquals('Contact Form', $browser->text('header h1'));
        });
    }

    public function test_confirm_page_has_link_to_index_page(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $browser->clickLink('Contact Form');
            $browser->assertPathIs('/');
        });
    }

    public function test_confirm_page_has_h2(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $this->assertEquals('お問い合わせ内容確認', $browser->text('h2'));
        });
    }

    public function test_confirm_page_receives_parameters_from_index_page(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            foreach ($params as $name => $value) {
                if ($name === 'content') {
                    $input = $browser->inputValue($name);
                    $this->assertEquals(trim($value), trim($input));
                } else {
                    $browser->assertInputValue($name, $value);
                }
            }
        });
    }

    public function test_confirm_page_has_send_button(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $this->assertEquals('送信', $browser->text('form button'));
        });
    }

    public function test_thanks_page_is_displayed_when_send_button_is_pressed(): void
    {
        $this->browseConfirmPageWithValidParams(function (Browser $browser, array $params) {
            $browser->press('送信');
            $browser->assertPathIs('/contacts');
        });
    }

    private function browseConfirmPageWithValidParams(callable $test)
    {
        $this->browse(function (Browser $browser) use ($test) {
            foreach (TestData::makeValidParamsList() as $params) {
                self::visitConfirmPageWithParams($browser, $params);
                $test($browser, $params);
            }
        });
    }

    private static function visitConfirmPageWithParams(Browser $browser, array $params)
    {
        $browser->visit('/');
        foreach ($params as $name => $value) {
            $browser->type($name, $value);
        }
        $browser->press('送信');
    }
}
