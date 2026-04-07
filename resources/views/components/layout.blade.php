<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Presto' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

    @include('components.navbar')

    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="main-content">
        {{ $slot }}
    </main>

    @include('components.footer')

    @livewireScripts
</body>
</html>