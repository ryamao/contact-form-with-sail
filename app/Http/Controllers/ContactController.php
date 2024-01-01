<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Tests\TestData;

class ContactController extends Controller
{
    private const array RULES = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'tel' => ['required', 'numeric', 'digits_between:10,11'],
    ];

    private const array MESSAGES = [
        'name.required' => '名前を入力してください',
        'name.string' => '名前を文字列で入力してください',
        'name.max' => '名前を255文字以下で入力してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => '有効なメールアドレス形式を入力してください',
        'email.max' => 'メールアドレスを255文字以下で入力してください',
        'tel.required' => '電話番号を入力してください',
        'tel.numeric' => '電話番号を数値で入力してください',
        'tel.digits_between' => '電話番号を10桁から11桁の間で入力してください',
    ];

    public function index(): View
    {
        return view('index');
    }

    public function confirm(Request $request): View
    {
        Validator::validate($request->all(), self::RULES, self::MESSAGES);
        return view('confirm', $request->only(['name', 'email', 'tel', 'content']));
    }

    public function store(Request $request): View|RedirectResponse|Response
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);
        if ($validator->fails()) {
            return redirect('/');
        }

        // TODO お問い合わせ内容をデータベースに保存する

        return response('Contact Form');
    }
}
