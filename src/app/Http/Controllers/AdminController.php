<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        $query = Contact::query();

        // 名前かメールアドレス部分一致検索
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%')
                ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }

        // 性別
        if ($request->filled('gender') && $request->gender !== '全て') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類
        if ($request->filled('category')) {
            $query->where('categories', $request->category);
        }

        // 日付
        if ($request->filled('contact_date')) {
            $query->whereDate('created_at', $request->contact_date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7)->withQueryString();

        return view('admin', compact('contacts'));
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/search')->with('success', '削除しました');
    }

    public function export(Request $request)
    {
        // 応用機能: 検索条件付きでCSV出力
    }
}