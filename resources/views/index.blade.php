<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div class="bg-black text-white">
            <div class="max-w-screen-md mx-auto">
                <h1 class="text-2xl p-4">
                    <a href="/">Contact Form</a>
                </h1>
            </div>
        </div>
    </header>

    <main>
        <form action="/contacts/confirm" method="post">
            @csrf
            <div class="mx-4 sm:mx-0">
                <div class="my-4 sm:my-8">
                    <h2 class="text-xl font-bold text-center">お問い合わせ</h2>
                </div>

                <div class="sm:w-4/5 sm:max-w-screen-sm sm:mx-auto sm:grid sm:grid-cols-[1fr_2fr] sm:grid-rows-[1fr_1fr_1fr_3fr]">
                    <div class="space-y-0.5 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
                        <div>
                            <label for="input-name">
                                <div class="space-x-1">
                                    <span>お名前</span>
                                    <span class="required">必須</span>
                                </div>
                            </label>
                        </div>
                        <div class="h-14 sm:h-16">
                            <div>
                                <input id="input-name" type="text" name="name" placeholder="テスト太郎" value="{{ old('name') }}" class="text-box" />
                            </div>
                            @error('name')
                            <div class="text-sm text-red-600 sm:mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-0.5 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
                        <div>
                            <label for="input-email">
                                <div class="space-x-1">
                                    <span>メールアドレス</span>
                                    <span class="required">必須</span>
                                </div>
                            </label>
                        </div>
                        <div class="h-14">
                            <div>
                                <input id="input-email" type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" class="text-box" />
                            </div>
                            @error('email')
                            <div class="text-sm text-red-600 sm:mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
                        <div>
                            <label for="input-tel">
                                <div class="space-x-1">
                                    <span>電話番号</span>
                                    <span class="required">必須</span>
                                </div>
                            </label>
                        </div>
                        <div class="h-14">
                            <div>
                                <input id="input-tel" type="tel" name="tel" placeholder="09012345678" value="{{ old('tel') }}" class="text-box" />
                            </div>
                            @error('tel')
                            <div class="text-sm text-red-600 sm:mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
                        <div>
                            <label for="input-content">
                                <span>お問い合わせ内容</span>
                            </label>
                        </div>
                        <div class="h-40 sm:h-full">
                            <textarea id="input-content" name="content" placeholder="資料をいただきたいです" class="text-box h-full">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <button class="bg-black text-white px-20 py-2 rounded">送信</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>