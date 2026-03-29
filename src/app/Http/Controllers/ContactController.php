<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

   public function store()
   {
     // ここに処理を記述していきます。
   }
   public function thanks()
   {
    return view('thanks');
   }

   public function confirm(Request $request)
  {
    $request->validate([
        // 1. お名前
        'last_name' => 'required',
        'first_name' => 'required',

        // 2. 性別
        'gender' => 'required',

        // 3. メール
        'email' => 'required|email',

        // 4. 電話番号
        'tel' => ['required', 'regex:/^[0-9]+$/', 'max:5'],

        // 5. 住所
        'address' => 'required',

        // 7. お問い合わせの種類
        'category' => 'required',

        // 8. お問い合わせ内容
        'message' => 'required|max:120',
    ], [
        // お名前
        'last_name.required' => '姓を入力してください',
        'first_name.required' => '名を入力してください',

        // 性別
        'gender.required' => '性別を選択してください',

        // メール
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスはメール形式で入力してください',

        // 電話番号
        'tel.required' => '電話番号を入力してください',
        'tel.regex' => '電話番号は 半角英数字で入力してください',
        'tel.max' => '電話番号は 5桁まで数字で入力してください',

        // 住所
        'address.required' => '住所を入力してください',

        // お問い合わせ種類
        'category.required' => 'お問い合わせの種類を選択してください',

        // お問い合わせ内容
        'message.required' => 'お問い合わせ内容を入力してください',
        'message.max' => 'お問い合わせ内容は120文字以内で入力してください',
    ]);

    return view('confirm', compact('request'));
  }
}
