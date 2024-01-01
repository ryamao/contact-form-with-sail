<x-app-layout subTitle="お問い合わせ">
    <form action="/contacts/confirm" method="post">
        @csrf
        <div class="grid grid-rows-[repeat(3,5.5rem)_12rem] sm:w-11/12 sm:max-w-screen-md sm:mx-auto sm:grid-cols-[auto_minmax(0,1fr)] sm:grid-rows-[repeat(3,4rem)_12rem]">
            <div class="max-sm:space-y-0.5 sm:grid sm:grid-cols-subgrid sm:col-span-2 sm:grid-rows-subgrid">
                <div class="sm:mr-10">
                    <label for="input-name">
                        <span>
                            <span class="mr-1">お名前</span>
                            <span class="required">必須</span>
                        </span>
                    </label>
                </div>
                <div>
                    <div>
                        <input id="input-name" type="text" name="name" placeholder="テスト太郎" value="{{ old('name') }}" class="text-box" />
                    </div>
                    @error('name')
                    <div class="text-sm text-red-600 mt-0.5">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="max-sm:space-y-0.5 sm:grid sm:grid-cols-subgrid sm:col-span-2 sm:grid-rows-subgrid">
                <div class="sm:mr-10">
                    <label for="input-email">
                        <span>
                            <span class="mr-1">メールアドレス</span>
                            <span class="required">必須</span>
                        </span>
                    </label>
                </div>
                <div>
                    <div>
                        <input id="input-email" type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" class="text-box" />
                    </div>
                    @error('email')
                    <div class="text-sm text-red-600 mt-0.5">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="max-sm:space-y-0.5 sm:grid sm:grid-cols-subgrid sm:col-span-2 sm:grid-rows-subgrid">
                <div class="sm:mr-10">
                    <label for="input-tel">
                        <span>
                            <span class="mr-1">電話番号</span>
                            <span class="required">必須</span>
                        </span>
                    </label>
                </div>
                <div>
                    <div>
                        <input id="input-tel" type="tel" name="tel" placeholder="09012345678" value="{{ old('tel') }}" class="text-box" />
                    </div>
                    @error('tel')
                    <div class="text-sm text-red-600 mt-0.5">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="max-sm:space-y-0.5 sm:grid sm:grid-cols-subgrid sm:col-span-2 sm:grid-rows-subgrid">
                <div class="sm:mr-10">
                    <label for="input-content">
                        <span>お問い合わせ内容</span>
                    </label>
                </div>
                <div class="h-full">
                    <textarea id="input-content" name="content" placeholder="資料をいただきたいです" class="text-box h-full appearance-none">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>

        <div class="text-center max-sm:my-12 mt-8">
            <button class="bg-black text-white px-20 py-2 rounded">送信</button>
        </div>
    </form>
</x-app-layout>