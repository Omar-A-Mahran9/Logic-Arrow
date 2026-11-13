<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'لوحة التحكم') — Logic Arrow</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0a3a72; --navy-raised: #24518a; --blue: #1e6fd9; --teal: #19c3c9; --panel: #e8eef5;
            --surface: #f5f8fb; --ink: #1b2430; --muted: #556070; --line: #d3dce6; --white: #fff; --danger: #b42318;
            --shadow: 0 8px 24px 0 rgba(30, 70, 54, .08), 0 1px 2px 0 rgba(43, 45, 49, .06);
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Noto Sans Arabic', system-ui, sans-serif; background: var(--surface); color: var(--ink); line-height: 1.7; }
        a { color: var(--blue); text-decoration: none; }
        a:hover { text-decoration: underline; }
        .container { max-width: 1120px; margin: 0 auto; padding: 0 16px; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--line); box-shadow: var(--shadow); }
        .topbar .container { display: flex; align-items: center; justify-content: space-between; gap: 16px; height: 64px; }
        .topbar img { height: 36px; display: block; }
        .topbar .user { display: flex; align-items: center; gap: 12px; font-size: 14px; color: var(--muted); }
        main { padding: 32px 0 64px; }
        h1 { font-size: 24px; margin: 0 0 24px; color: var(--navy); }
        .card { background: var(--white); border-radius: 7px; box-shadow: var(--shadow); }
        .btn { display: inline-flex; align-items: center; gap: 6px; border: 1px solid transparent; border-radius: 4px; padding: 6px 16px; font: inherit; font-weight: 700; font-size: 15px; cursor: pointer; text-decoration: none !important; }
        .btn-primary { background: var(--blue); color: var(--white); }
        .btn-primary:hover { background: var(--navy); }
        .btn-outline { background: var(--white); color: var(--blue); border-color: var(--blue); }
        .btn-ghost { background: transparent; color: var(--blue); border-color: var(--line); }
        .btn-danger { background: var(--white); color: var(--danger); border-color: var(--danger); }
        input[type=text], input[type=email], input[type=password], input[type=search], select {
            font: inherit; width: 100%; padding: 8px 12px; border: 1px solid var(--line); border-radius: 8px; background: var(--white); color: var(--ink);
        }
        input:focus, select:focus { outline: 2px solid var(--blue); outline-offset: 1px; }
        .alert { padding: 12px 16px; border-radius: 8px; background: var(--panel); color: var(--navy); margin-bottom: 16px; }
        .error { color: var(--danger); font-size: 14px; margin-top: 4px; }
        .ltr { direction: ltr; unicode-bidi: isolate; display: inline-block; }
    </style>
    @stack('styles')
</head>
<body>
@auth
    <header class="topbar">
        <div class="container">
            <a href="{{ route('admin.inquiries.index') }}"><img src="{{ asset('logo.png') }}" alt="Logic Arrow"></a>
            <div class="user">
                <span>{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-ghost" type="submit">تسجيل الخروج</button>
                </form>
            </div>
        </div>
    </header>
@endauth
<main>
    <div class="container">
        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif
        @yield('content')
    </div>
</main>
@stack('scripts')
</body>
</html>
