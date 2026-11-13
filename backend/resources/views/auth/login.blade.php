@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@push('styles')
<style>
    main { min-height: 100vh; display: grid; place-items: center; padding: 16px 0; }
    .login { width: 100%; max-width: 400px; margin: 0 auto; padding: 40px 32px; }
    .login img { height: 44px; margin: 0 auto 24px; display: block; }
    .login h1 { text-align: center; font-size: 20px; }
    .field { margin-bottom: 16px; }
    .field label { display: block; font-weight: 500; margin-bottom: 4px; font-size: 15px; }
    .remember { display: flex; align-items: center; gap: 8px; margin-bottom: 24px; font-size: 14px; }
    .login .btn { width: 100%; justify-content: center; padding-block: 10px; }
</style>
@endpush

@section('content')
    <form class="card login" method="POST" action="{{ route('login') }}">
        @csrf
        <img src="{{ asset('logo.png') }}" alt="Logic Arrow">
        <h1>تسجيل الدخول إلى لوحة التحكم</h1>

        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" dir="ltr">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" dir="ltr">
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <label class="remember">
            <input type="checkbox" name="remember" value="1"> تذكرني
        </label>

        <button class="btn btn-primary" type="submit">دخول</button>
    </form>
@endsection
