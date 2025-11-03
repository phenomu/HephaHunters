<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HephaCode - Advanced Server Security Scanner</title>
    <link href="{{ asset('css/outputs.css') }}" rel="stylesheet">
    <!--<script src="https://cdn.tailwindcss.com"></script>-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="https://low.my.id/hepha.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&family=Source_Sans_3:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #0a0e1a;
            background-image: radial-gradient(circle at top, #1a2035, #0a0e1a 40%);
        }
        
        .fh {
            font-family: 'Roboto Mono', monospace;
        }

        @keyframes flicker {
            0%, 100% { text-shadow: 0 0 5px #0ea5e9, 0 0 10px #0ea5e9; color: #7dd3fc; }
            50% { text-shadow: 0 0 10px #0ea5e9, 0 0 20px #0ea5e9; color: #e0f2fe; }
        }
        .flickers {
            animation: flicker 2s infinite linear;
        }

        .btn-glow {
            box-shadow: 0 0 10px rgba(14, 165, 233, 0.5), 0 0 20px rgba(14, 165, 233, 0.3);
            transition: all 0.3s ease-in-out;
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(14, 165, 233, 0.8), 0 0 30px rgba(14, 165, 233, 0.6);
            transform: translateY(-2px);
        }

    </style>
</head>
<body class="bg-slate-900 text-slate-300 antialiased relative min-h-screen flex flex-col">

    <div class="absolute inset-0 z-[-1] h-full w-full bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px]"></div>

    <nav class="fixed top-0 w-full z-50 bg-slate-900/80 backdrop-blur-sm border-b border-slate-700/50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="text-2xl font-bold text-white fh">Hepha<span class="text-cyan-400">Code</span></a>
            <div class="hidden md:flex items-center space-x-8 text-sm">
                <a href="{{ route('dashboard') }}" class="text-cyan-400 font-semibold">Dashboard</a>
                <a href="#" class="hover:text-cyan-400 transition">Reports</a>
                <a href="#" class="hover:text-cyan-400 transition">Settings</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hidden md:inline-block bg-cyan-500 text-slate-900 font-bold py-2 px-5 rounded-md hover:bg-cyan-400 transition-colors duration-300">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="pt-32 pb-20 text-center">
        @yield('content')
    </main>

    <footer class="border-t border-slate-800 py-6 text-center text-sm text-slate-500">
        &copy; 2025 HephaCode — Cyber Security Intelligence.
    </footer>

</body>
</html>
