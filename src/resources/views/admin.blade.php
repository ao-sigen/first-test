@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-class', 'admin-header') {{-- ← 追加することで admin用ヘッダーに切り替え可 --}}

@section('content')
<div class="admin-title">
    <h1 class="title">Admin</h1>
</div>
<div class="admin-container">

    <!-- ▼検索フォーム -->
    <form class="search-form" method="GET" action="/search">
        <input type="text" name="name" placeholder="名前やメールアドレスを入力してください" value="{{ request('name') }}">
        <select name="gender">
            <option value="">性別</option>
            <option value="全て">全て</option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
            <option value="その他">その他</option>
        </select>
        <select name="category">
            <option value="">お問い合わせ種類</option>
            <option value="商品のお届けについて">商品のお届けについて</option>
            <option value="商品の交換について">商品の交換について</option>
            <option value="商品トラブル">商品トラブル</option>
            <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
            <option value="その他">その他</option>
        </select>

        <input type="date" name="contact_date">

        <button type="submit">検索</button>
        <button type="reset" onclick="location.href='/search'">リセット</button>
        <div class="export-pagination">
            <button type="submit" formaction="/export" formmethod="GET">エクスポート</button>
            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        </div>
    </form>

    <!-- ▼検索結果 -->
    <table class="contact-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>お問い合わせ種類</th>
                <th>日付</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->gender }}</td>
                <td>{{ $contact->categories }}</td>
                <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                <td>
                    <button class="detail-button"
                        data-id="{{ $contact->id }}"
                        data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                        data-email="{{ $contact->email }}"
                        data-gender="{{ $contact->gender }}"
                        data-tel="{{ $contact->tel1 }}-{{ $contact->tel2 }}-{{ $contact->tel3 }}"
                        data-address="{{ $contact->address }}"
                        data-building="{{ $contact->building }}"
                        data-category="{{ $contact->categories }}"
                        data-detail="{{ $contact->detail }}"
                        onclick="openModal(this)">
                        詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">×</span>
            <div class="modal-item"><label>お名前：</label><span id="modal-name"></span></div>
            <div class="modal-item"><label>性別：</label><span id="modal-gender"></span></div>
            <div class="modal-item"><label>メールアドレス：</label><span id="modal-email"></span></div>
            <div class="modal-item"><label>電話番号：</label><span id="modal-tel"></span></div>
            <div class="modal-item"><label>住所：</label><span id="modal-address"></span></div>
            <div class="modal-item"><label>建物名：</label><span id="modal-building"></span></div>
            <div class="modal-item"><label>お問い合わせ種類：</label><span id="modal-category"></span></div>
            <div class="modal-item"><label>お問い合わせ内容：</label><span id="modal-detail"></span></div>

            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/script.js') }}"></script>
@endsection