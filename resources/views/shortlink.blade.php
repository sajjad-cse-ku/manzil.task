<!DOCTYPE html>
<html>
<head>
    <title>Laravel Link Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Link Shortener</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('shorten') }}" method="POST" class="mb-6">
        @csrf
        <input type="url" name="original_url" placeholder="https://example.com" required class="border p-2 w-full mb-2">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Shorten</button>
    </form>

    <h2 class="text-xl font-semibold mb-2">Shortened Links</h2>
    <ul>
        @foreach($shortLinks as $link)
            <li class="mb-2">
                <a href="{{ route('shortlink.redirect', $link->short_code) }}" target="_blank" class="text-blue-600">
                    {{ url($link->short_code) }}
                </a> <br>
                <small class="text-gray-600">Clicks: {{ $link->clicks }} | Original: {{ $link->original_url }}</small>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
