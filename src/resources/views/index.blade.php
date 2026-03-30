<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FashionablyLate</title>
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">

<style>
/* カードの囲いを削除 */
.card {
    max-width: 600px;
    margin: 40px auto;
    padding: 0;               /* 余白は必要に応じて調整 */
    background: transparent;  /* 背景を透明に */
    border-radius: 0;         /* 角丸なし */
    box-shadow: none;         /* シャドウなし */
}

/* 行の設定 */
.row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

/* ラベル */
.label {
    width: 140px; /* ラベルの横幅 */
    font-weight: bold;
}

/* 入力欄の設定 */
.field {
    flex: 1;
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* 名前や電話番号の間隔 */
}

.field input[type="text"],
.field input[type="email"],
.field select,
.field textarea {
    flex: 1;
    padding: 8px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* お問い合わせ種類 ▼ カスタム */
.field select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: white url("data:image/svg+xml,%3Csvg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E") no-repeat right 10px center;
    background-size: 16px 16px;
    padding-right: 30px;
}

/* エラー表示 */
.error {
    color: red;
    display: block;
    margin-top: 5px;
    width: 100%;
}

/* ボタン */
button.btn-submit {
    padding: 12px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto; /* 中央配置 */
}

button.btn-submit:hover {
    background-color: #555;
}

/* Contact のタイトル下の線を消す */
.card .title {
    border-bottom: none;
    padding-bottom: 0;
}
</style>
</head>
<body>

<h1 class="brand">Fashionably Late</h1>

<div class="card">
  <h2 class="title">Contact</h2>

  <form action="/contacts/confirm" method="POST">
    @csrf

    <!-- お名前 -->
    <div class="row">
      <div class="label">お名前 <span class="required">※</span></div>
      <div class="field">
        <input type="text" name="last_name" placeholder="山田" value="{{ old('last_name') }}">
        <input type="text" name="first_name" placeholder="太郎" value="{{ old('first_name') }}">
        @error('last_name')<span class="error">{{ $message }}</span>@enderror
        @error('first_name')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- 性別 -->
    <div class="row">
      <div class="label">性別 <span class="required">※</span></div>
      <div class="field">
        <label><input type="radio" name="gender" value="男性" {{ old('gender')=='男性'?'checked':'' }}>男性</label>
        <label><input type="radio" name="gender" value="女性" {{ old('gender')=='女性'?'checked':'' }}>女性</label>
        <label><input type="radio" name="gender" value="その他" {{ old('gender')=='その他'?'checked':'' }}>その他</label>
        @error('gender')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- メール -->
    <div class="row">
      <div class="label">メールアドレス <span class="required">※</span></div>
      <div class="field">
        <input type="text" name="email" placeholder="test@example.com" value="{{ old('email') }}">
        @error('email')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- 電話番号 -->
    <div class="row">
      <div class="label">電話番号 <span class="required">※</span></div>
      <div class="field">
        <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="000" style="width:60px;"> -
        <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="000" style="width:60px;"> -
        <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="0000" style="width:80px;">
        @error('tel')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- 住所 -->
    <div class="row">
      <div class="label">住所 <span class="required">※</span></div>
      <div class="field">
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- 建物名 -->
    <div class="row">
      <div class="label">建物名</div>
      <div class="field">
        <input type="text" name="building" value="{{ old('building') }}">
        @error('building')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- お問い合わせ種類 -->
    <div class="row">
      <div class="label">お問い合わせの種類 <span class="required">※</span></div>
      <div class="field">
        <select name="type">
          <option value="">選択してください</option>
          <option value="1" {{ old('type')=='1'?'selected':'' }}>商品のお届けについて</option>
          <option value="2" {{ old('type')=='2'?'selected':'' }}>商品の交換について</option>
          <option value="3" {{ old('type')=='3'?'selected':'' }}>商品トラブル</option>
          <option value="4" {{ old('type')=='4'?'selected':'' }}>ショップへのお問い合わせ</option>
          <option value="5" {{ old('type')=='5'?'selected':'' }}>その他</option>
        </select>
        @error('type')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <!-- お問い合わせ内容 -->
    <div class="row">
      <div class="label">お問い合わせ内容 <span class="required">※</span></div>
      <div class="field">
        <textarea name="message" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('message') }}</textarea>
        @error('message')<span class="error">{{ $message }}</span>@enderror
      </div>
    </div>

    <button type="submit" class="btn-submit">確認画面</button>
  </form>
</div>

</body>
</html