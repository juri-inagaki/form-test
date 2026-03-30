<h1 class="title">FashionablyLate</h1>
<div class="container">   
    <h2 class="subtitle">Confirm</h2>
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $data['last_name'] ?? '' }} {{ $data['first_name'] ?? '' }}</td>
        </tr>

        <tr>
            <th>性別</th>
            <td>{{ $data['gender'] ?? '' }}</td>
        </tr>

        <tr>
            <th>メールアドレス</th>
            <td>{{ $data['email'] ?? '' }}</td>
        </tr>

        <tr>
            <th>電話番号</th>
            <td class="tel-display">
 　　　　    {{ $data['tel'] ?? '' }}
            @if(!empty($data['tel_error']))
            <p style="color:red;margin:0;">{{ $data['tel_error'] }}</p>
            @endif
           </td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $data['address'] ?? '' }}</td>
        </tr>

        <tr>
            <th>建物名</th>
            <td>{{ $data['building'] ?? '' }}</td>
        </tr>

        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $data['type_text'] ?? '' }}</td>
        </tr>

        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $data['message'] ?? '' }}</td>
        </tr>
    </table>

    <div class="button-area">
        <!-- 送信 -->
        <form action="{{ route('thanks') }}" method="POST" style="display:inline;">
            @csrf
            @foreach($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="btn-submit">送信</button>
        </form>

        <!-- 修正 -->
        <a href="{{ url('/') }}" class="btn-edit">修正</a>
    </div>
</div>