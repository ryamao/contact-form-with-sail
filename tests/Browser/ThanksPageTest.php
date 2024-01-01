<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestData;

class ThanksPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_thanks_page_path_is_contacts(): void
    {
        $this->browseThanksPageWithValidParams(function (Browser $browser) {
            $browser->assertPathIs('/contacts');
        });
    }

    public function test_thanks_page_title_is_contact_form(): void
    {
        $this->browseThanksPageWithValidParams(function (Browser $browser) {
            $browser->assertTitle('Contact Form');
        });
    }

    public function test_thanks_page_has_h1_in_header(): void
    {
        $this->browseThanksPageWithValidParams(function (Browser $browser) {
            $this->assertEquals('Contact Form', $browser->text('header h1'));
        });
    }

    public function test_thanks_page_has_link_to_index_page(): void
    {
        $this->browseThanksPageWithValidParams(function (Browser $browser) {
            $browser->clickLink('Contact Form');
            $browser->assertPathIs('/');
        });
    }

    public function test_thanks_page_has_h2(): void
    {
        $this->browseThanksPageWithValidParams(function (Browser $browser) {
            $this->assertEquals('お問い合わせありがとうございます', $browser->text('h2'));
        });
    }

    private function browseThanksPageWithValidParams(callable $test)
    {
        $this->browse(function (Browser $browser) use ($test) {
            foreach (TestData::makeValidParamsList() as $params) {
                self::visitThanksPageWithParams($browser, $params);
                $test($browser);
            }
        });
    }

    private static function visitThanksPageWithParams(Browser $browser, array $params)
    {
        $browser->visit('/');
        foreach ($params as $name => $value) {
            $browser->type($name, $value);
        }
        $browser->press('送信');
        $browser->press('送信');
    }
}
