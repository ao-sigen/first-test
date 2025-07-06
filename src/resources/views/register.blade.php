@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-title">
    <h1 class="title">Register</h1>
</div>
<div class="register-container">
    <form action="{{ route('register') }}" method="POST" class="register-form">
        @csrf

        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" name="name" id="name" placeholder="例: 山田 太郎" value="{{ old('name') }}" required>
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="例: test@example.com" value="{{ old('email') }}" required>
        </div>
        <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="例: coachtech1106" required>
        </div>
        <div class="form__error">
            @error('password')
            {{ $message }}
            @enderror
        </div>

        <button type="submit" class="btn-register">登録</button>
    </form>
</div>
@endsection