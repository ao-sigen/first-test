// public/js/script.js

function openModal(button) {
    const modal = document.getElementById('modal');
    modal.classList.remove('hidden');

    // 各データ取得
    const name = button.getAttribute('data-name');
    const email = button.getAttribute('data-email');
    const tel = button.getAttribute('data-tel');
    const address = button.getAttribute('data-address');
    const building = button.getAttribute('data-building');
    const gender = button.getAttribute('data-gender');
    const category = button.getAttribute('data-category');
    const detail = button.getAttribute('data-detail');
    const id = button.getAttribute('data-id');

    // モーダル内へ埋め込み
    document.getElementById('modal-name').textContent = `${name}`;
    document.getElementById('modal-email').textContent = `${email}`;
    document.getElementById('modal-tel').textContent = `${tel}`;
    document.getElementById('modal-address').textContent = `${address}`;
    document.getElementById('modal-building').textContent = `${building}`;
    document.getElementById('modal-gender').textContent = `${getGenderLabel(gender)}`;
    document.getElementById('modal-category').textContent = `${category}`;
    document.getElementById('modal-detail').textContent = `${detail}`;

    // 削除フォームのアクション設定
    const form = document.getElementById('delete-form');
    form.action = `/contacts/${id}`;
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

function getGenderLabel(gender) {
    switch (parseInt(gender)) {
        case 1: return '男性';
        case 2: return '女性';
        default: return 'その他';
    }
}
