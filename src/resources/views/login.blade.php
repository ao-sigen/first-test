@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-title">
    <h1 class="title">Login</h1>
</div>
<div class="login-container">
    <form action="{{ route('login') }}" method="POST" class="login-form">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" required>
            @error('email')
            {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="例: coachtech1106" required>
            @error('password')
            {{ $message }}
            @enderror
        </div>

        <button type="submit" class="submit-button">ログイン</button>
    </form>
</div>
@endsection