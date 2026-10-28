<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Spellen Webshop')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body { font-family: ui-sans-serif, system-ui, sans-serif; margin: 0; background: #f8fafc; color: #0f172a; }
            header { background: #fff; border-bottom: 1px solid #e2e8f0; }
            header > div, main, footer > div { max-width: 72rem; margin: 0 auto; padding: 1rem; }
            header nav { display: flex; flex-wrap: wrap; gap: 0.25rem; }
            header nav a { padding: 0.375rem 0.75rem; border-radius: 9999px; color: #64748b; }
            main a { color: #2563eb; }
            main { padding-top: 2.5rem; padding-bottom: 2.5rem; }
            table { border-collapse: collapse; width: 100%; background: #fff; }
            th, td { border-bottom: 1px solid #f1f5f9; padding: 0.875rem 1.25rem; text-align: left; vertical-align: top; }
            th { border-bottom-color: #e2e8f0; font-size: 0.7rem; letter-spacing: 0.08em; text-transform: uppercase; color: #94a3b8; }
            .btn { display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 0.5rem; background: #0f172a; color: #fff; padding: 0.625rem 1rem; font-size: 0.875rem; border: 0; cursor: pointer; }
            .btn-secondary { background: #fff; color: #475569; border: 1px solid #e2e8f0; }
            .btn-danger { background: #e11d48; }
            .btn-danger:hover, .btn:hover { filter: brightness(1.15); }
            .btn[disabled] { background: #f1f5f9; color: #94a3b8; cursor: not-allowed; }
            .alert { border: 1px solid #6ee7b7; background: #ecfdf5; color: #065f46; border-radius: 0.5rem; padding: 0.75rem 1rem; font-size: 0.875rem; }
            .alert-error { border-color: #fda4af; background: #fff1f2; color: #9f1239; }
            .modal-content { background: #fff; border-radius: 1rem; padding: 1.5rem; }
            .modal-header { display: flex; justify-content: space-between; gap: 1rem; }
            .modal-header h2 { margin: 0; font-size: 1.125rem; }
            .modal-close { background: none; border: 0; font-size: 1.5rem; color: #94a3b8; cursor: pointer; }
            .form-label { display: block; font-size: 0.875rem; margin-bottom: 0.375rem; }
            .form-input { width: 100%; box-sizing: border-box; border: 1px solid #cbd5e1; border-radius: 0.5rem; padding: 0.625rem 0.875rem; font-size: 0.9375rem; }
            .form-error { color: #e11d48; font-size: 0.875rem; }
            .form-actions { display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 1.5rem; }
        </style>
    @endif
</head>
<body class="flex min-h-screen flex-col bg-slate-50 text-slate-900 antialiased">
    <header class="sticky top-0 z-40 border-b border-slate-900/5 bg-white/85 backdrop-blur">
        <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-x-6 gap-y-3 px-6 py-3 lg:px-8">
            <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-2.5">
                <span class="grid h-7 w-7 place-items-center rounded-lg bg-slate-900 text-sm font-semibold text-white">S</span>
                <span class="text-[15px] font-semibold tracking-tight">Spellen Webshop</span>
            </a>

            <nav class="flex flex-wrap items-center justify-end gap-1 text-[13px] font-medium">
                <a href="{{ route('categories.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('categories.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Categorieën</a>
                <a href="{{ route('products.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('products.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Producten</a>
                <a href="{{ route('prices.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('prices.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Prijzen</a>
                <a href="{{ route('reviews.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('reviews.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Reviews</a>
                <a href="{{ route('orders.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('orders.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Bestellingen</a>
                <a href="{{ route('orderrows.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('orderrows.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Bestelregels</a>
                <a href="{{ route('users.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('users.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Gebruikers</a>
                <a href="{{ route('roles.index') }}" @class(['rounded-full px-3 py-1.5 transition-colors', request()->routeIs('roles.*') ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'])>Rollen</a>

                @auth
                    <span class="ml-2 hidden items-center gap-2 border-l border-slate-200 pl-4 sm:flex">
                        <span class="max-w-[10rem] truncate text-[13px] text-slate-400">{{ auth()->user()->name }}</span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="rounded-full px-3 py-1.5 text-[13px] font-medium text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-900">
                                Uitloggen
                            </button>
                        </form>
                    </span>
                @else
                    <a href="{{ route('login') }}" class="rounded-full px-3 py-1.5 text-[13px] font-medium text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-900">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-6 py-10 lg:px-8">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex w-full max-w-6xl flex-wrap items-center justify-between gap-3 px-6 py-6 text-xs text-slate-400 lg:px-8">
            <span>Spellen Webshop</span>
            <span>Gebouwd met Laravel &amp; Blade</span>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
