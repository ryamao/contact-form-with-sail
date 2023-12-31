<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>

<body>
    <header>
        <h1><a href="/">Contact Form</a></h1>
    </header>

    <main>
        <form action="/contacts/confirm" method="post">
            @csrf
            <div>
                <div>
                    <h2>お問い合わせ</h2>
                </div>
                <div>
                    <div>
                        <span><label for="input-name">お名前</label></span>
                        <span>必須</span>
                    </div>
                    <div>
                        <div>
                            <input id="input-name" type="text" name="name" placeholder="テスト太郎" value="{{ old('name') }}" />
                        </div>
                        @error('name')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <div>
                        <span><label for="input-email">メールアドレス</label></span>
                        <span>必須</span>
                    </div>
                    <div>
                        <div>
                            <input id="input-email" type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                        </div>
                        @error('email')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <div>
                        <span><label for="input-tel">電話番号</label></span>
                        <span>必須</span>
                    </div>
                    <div>
                        <div>
                            <input id="input-tel" type="tel" name="tel" placeholder="09012345678" value="{{ old('tel') }}" />
                        </div>
                        @error('tel')
                        <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <div>
                        <span><label for="input-content">お問い合わせ内容</label></span>
                    </div>
                    <div>
                        <div>
                            <textarea id="input-content" name="content" placeholder="資料をいただきたいです">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <button>送信</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>