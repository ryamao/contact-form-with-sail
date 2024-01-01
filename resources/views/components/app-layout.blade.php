@props(['subTitle'])

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
            <div class="max-w-screen-xl mx-auto">
                <h1 class="text-2xl p-4">
                    <a href="/">Contact Form</a>
                </h1>
            </div>
        </div>
    </header>

    <main>
        <div class="max-sm:mx-4">
            <div class="my-4 sm:my-10">
                <h2 class="text-xl font-bold text-center">{{ $subTitle }}</h2>
            </div>

            {{ $slot }}
        </div>
    </main>
</body>

</html>