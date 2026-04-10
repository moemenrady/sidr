<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sidr') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @yield('style')

    <style>
        html {
            scroll-behavior: smooth;
            background: var(--sidr-cream)
        }

        /* زر الرجوع */
        .back-nav {
            max-width: 1200px;
            margin: 20px auto 0;
            padding: 0 40px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--olive-dark);
            font-weight: bold;
            transition: 0.3s;
            padding: 8px 0;
            border-bottom: 2px solid transparent;
        }

        .btn-back:hover {
            color: var(--sage);
            border-bottom-color: var(--sage);
        }
    </style>
</head>

<body class="font-sans antialiased">

    @yield('content')

    @stack('scripts')
    <script>
        function showSnackbar(message, type = "success") {
            const bar = document.createElement("div");
            bar.innerText = message;

            bar.style.position = "fixed";
            bar.style.bottom = "20px";
            bar.style.left = "50%";
            bar.style.transform = "translateX(-50%)";
            bar.style.padding = "12px 20px";
            bar.style.borderRadius = "8px";
            bar.style.color = "#fff";
            bar.style.zIndex = "9999";
            bar.style.background = type === "success" ? "#4CAF50" : "#D9534F";

            document.body.appendChild(bar);

            setTimeout(() => {
                bar.remove();
            }, 3000);
        }
    </script>
</body>

</html>
