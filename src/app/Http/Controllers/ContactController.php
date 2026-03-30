<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // ← スペースを入れて正しく

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name'  => 'required',
            'first_name' => 'required',
            'gender'     => 'required',
            'email'      => 'required|email',
            'address'    => 'required',
            'building'   => 'nullable',
            'type'       => 'required',
            'message'    => 'required|max:120',
        ], [
            // 日本語メッセージ
            'last_name.required'  => '姓は必ず指定してください。',
            'first_name.required' => '名は必ず指定してください。',
            'gender.required'     => '性別を選択してください。',
            'email.required'      => 'メールアドレスは必ず指定してください。',
            'email.email'         => 'メールアドレスの形式で入力してください。',
            'address.required'    => '住所は必ず指定してください。',
            'type.required'       => 'お問い合わせの種類を選択してください。',
            'message.required'    => 'お問い合わせ内容は必ず入力してください。',
            'message.max'         => 'お問い合わせ内容は120文字以内で入力してください。',
        ]);

        // 電話番号チェック
        $validator->after(function ($validator) use ($request) {
            $tel1 = $request->tel1;
            $tel2 = $request->tel2;
            $tel3 = $request->tel3;

            if (empty($tel1) || empty($tel2) || empty($tel3)) {
                $validator->errors()->add('tel', '電話番号を入力してください');
                return;
            }

            if (!ctype_digit($tel1) || !ctype_digit($tel2) || !ctype_digit($tel3)) {
                $validator->errors()->add('tel', '電話番号は半角数字で入力してください');
                return;
            }

            if (strlen($tel1) > 5 || strlen($tel2) > 5 || strlen($tel3) > 5) {
                $validator->errors()->add('tel', '電話番号は5桁まで数字で入力してください');
                return;
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $validated['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        // お問い合わせ種類を文字列に変換
        $types = [
            1 => '商品について',
            2 => '注文について',
            3 => '返品・交換について',
            4 => 'その他',
        ];
        $typeKey = intval($validated['type']);
        $validated['type_text'] = $types[$typeKey] ?? '';

        return view('confirm', ['data' => $validated]);
    }
}