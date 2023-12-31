<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexPageTest extends DuskTestCase
{
    public function test_index_page_path_is_root(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertPathIs('/');
        });
    }

    public function test_index_page_title_is_contact_form(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertTitle('Contact Form');
        });
    }

    public function test_index_page_has_h1_in_header(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $this->assertEquals('Contact Form', $browser->text('header h1'));
        });
    }

    public function test_index_page_has_link_to_index_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->clickLink('Contact Form');
            $browser->assertPathIs('/');
        });
    }

    public function test_index_page_has_h2(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $this->assertEquals('お問い合わせ', $browser->text('h2'));
        });
    }

    public function test_index_page_has_form(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertPresent('form');
            $browser->assertAttribute('form', 'action', '/contacts/confirm');
            $browser->assertAttribute('form', 'method', 'post');
        });
    }

    public function test_index_page_has_name_textbox(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertInputPresent('name');
            $browser->assertAttribute('form input[name="name"]', 'type', 'text');
            $browser->assertAttribute('form input[name="name"]', 'placeholder', 'テスト太郎');
            $browser->assertInputValue('name', '');
        });
    }

    public function test_index_page_has_email_textbox(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertInputPresent('email');
            $browser->assertAttribute('form input[name="email"]', 'type', 'email');
            $browser->assertAttribute('form input[name="email"]', 'placeholder', 'test@example.com');
            $browser->assertInputValue('email', '');
        });
    }

    public function test_index_page_has_tel_textbox(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertInputPresent('tel');
            $browser->assertAttribute('form input[name="tel"]', 'type', 'tel');
            $browser->assertAttribute('form input[name="tel"]', 'placeholder', '09012345678');
            $browser->assertInputValue('tel', '');
        });
    }

    public function test_index_page_has_content_textbox(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertInputPresent('content');
            $browser->assertAttribute('form textarea[name="content"]', 'placeholder', '資料をいただきたいです');
            $browser->assertInputValue('content', '');
        });
    }

    public function test_index_page_has_submit_button(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $this->assertEquals('送信', $browser->text('form button'));
        });
    }

    public function test_index_page_redirects_to_index_page_when_form_is_empty(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('送信');
            $browser->assertPathIs('/');
        });
    }

    public function test_index_page_has_not_error_messages(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertDontSee('名前を入力してください');
            $browser->assertDontSee('名前を255文字以下で入力してください');
            $browser->assertDontSee('メールアドレスを入力してください');
            $browser->assertDontSee('有効なメールアドレス形式を入力してください');
            $browser->assertDontSee('メールアドレスを255文字以下で入力してください');
            $browser->assertDontSee('電話番号を入力してください');
            $browser->assertDontSee('電話番号を数値で入力してください');
            $browser->assertDontSee('電話番号を10桁から11桁の間で入力してください');
        });
    }

    public function test_name_textbox_is_empty(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('送信');
            $browser->assertSee('名前を入力してください');
        });
    }

    public function test_name_textbox_is_too_long(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $name = str_repeat('a', 256);
            $browser->type('name', $name);
            $browser->press('送信');
            $browser->assertSee('名前を255文字以下で入力してください');
            $browser->assertInputValue('name', $name);
        });
    }

    public function test_email_textbox_is_empty(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('送信');
            $browser->assertSee('メールアドレスを入力してください');
        });
    }

    // ブラウザがメールアドレスの形式を検証するので
    // press('送信')で遷移しない。
    // public function test_email_textbox_is_invalid(): void
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/');
    //         $email = 'a';
    //         $browser->type('email', $email);
    //         $browser->press('送信');
    //         $browser->assertSee('有効なメールアドレス形式を入力してください');
    //         $browser->assertInputValue('email', $email);
    //     });
    // }

    public function test_email_textbox_is_too_long(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $email = str_repeat('a', 254) . '@a';
            $browser->type('email', $email);
            $browser->press('送信');
            $browser->assertSee('メールアドレスを255文字以下で入力してください');
            $browser->assertInputValue('email', $email);
        });
    }

    public function test_tel_textbox_is_empty(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('送信');
            $browser->assertSee('電話番号を入力してください');
        });
    }

    public function test_tel_textbox_is_not_integer(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $tel = 'a';
            $browser->type('tel', $tel);
            $browser->press('送信');
            $browser->assertSee('電話番号を数値で入力してください');
            $browser->assertInputValue('tel', $tel);
        });
    }

    public function test_tel_textbox_is_too_short(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $tel = str_repeat('0', 9);
            $browser->type('tel', $tel);
            $browser->press('送信');
            $browser->assertSee('電話番号を10桁から11桁の間で入力してください');
            $browser->assertInputValue('tel', $tel);
        });
    }

    public function test_tel_textbox_is_too_long(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $tel = str_repeat('0', 12);
            $browser->type('tel', $tel);
            $browser->press('送信');
            $browser->assertSee('電話番号を10桁から11桁の間で入力してください');
            $browser->assertInputValue('tel', $tel);
        });
    }

    public function test_tel_textbox_is_negative_integer(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $tel = '-123456789';
            $browser->type('tel', $tel);
            $browser->press('送信');
            $browser->assertSee('電話番号を10桁から11桁の間で入力してください');
            $browser->assertInputValue('tel', $tel);
        });
    }

    public function test_tel_textbox_is_decimal_integer(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $tel = '12345678.9';
            $browser->type('tel', $tel);
            $browser->press('送信');
            $browser->assertSee('電話番号を10桁から11桁の間で入力してください');
            $browser->assertInputValue('tel', $tel);
        });
    }

    public function test_content_textbox_fills_old_value_when_error_occurs(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->type('content', 'a');
            $browser->press('送信');
            $browser->assertInputValue('content', 'a');
        });
    }

    public function test_moves_to_next_page_when_all_inputs_are_filled(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->type('name', 'a');
            $browser->type('email', 'b@c');
            $browser->type('tel', '0123456789');
            $browser->type('content', 'd');
            $browser->press('送信');
            $browser->assertPathIs('/contacts/confirm');
        });
    }
}
