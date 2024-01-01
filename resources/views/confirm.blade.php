<x-app-layout subTitle="お問い合わせ内容確認">
    <div class="w-11/12 max-w-screen-md mx-auto border border-stone-300 sm:grid sm:grid-cols-[auto_minmax(0,1fr)]">
        <div class="border-b border-b-stone-300 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
            <div class="bg-stone-200 p-4 flex items-center justify-center">お名前</div>
            <div class="break-all p-4">{{ $name }}</div>
        </div>
        <div class="border-b border-b-stone-300 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
            <div class="bg-stone-200 p-4 flex items-center justify-center">メールアドレス</div>
            <div class="break-all p-4">{{ $email }}</div>
        </div>
        <div class="border-b border-b-stone-300 sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
            <div class="bg-stone-200 p-4 flex items-center justify-center">電話番号</div>
            <div class="break-all p-4">{{ $tel }}</div>
        </div>
        <div class="sm:grid sm:grid-cols-subgrid sm:grid-rows-subgrid sm:col-span-2">
            <div class="bg-stone-200 p-4 flex items-center justify-center">お問い合わせ内容</div>
            <div class="break-all p-4">{!! nl2br(e($content)) !!}</div>
        </div>
    </div>

    <div class="flex justify-center my-4 sm:mt-10">
        <form action="/contacts" method="post">
            @csrf
            <input type="text" name="name" value="{{ $name }}" class="hidden" />
            <input type="email" name="email" value="{{ $email }}" class="hidden" />
            <input type="tel" name="tel" value="{{ $tel }}" class="hidden" />
            <textarea name="content" class="hidden">{{ $content }}</textarea>
            <button class="bg-black text-white px-20 py-2 rounded">送信</button>
        </form>
    </div>
</x-app-layout>