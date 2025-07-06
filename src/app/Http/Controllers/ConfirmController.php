<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;


class ConfirmController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'categories', 'detail']);

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'categories',
            'detail'
        ]);
        Contact::create($contact);

        return view('thanks');
    }
    public function export(Request $request)
    {
        // 検索条件がある場合、それを使って絞り込み
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category')) {
            $query->where('categories', $request->category);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $contacts = $query->get();

        // CSVの内容を生成
        $csvData = [];
        $csvData[] = ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'カテゴリ', '登録日'];
        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender,
                $contact->email,
                $contact->tel1 . '-' . $contact->tel2 . '-' . $contact->tel3,
                $contact->address,
                $contact->building,
                $contact->categories,
                $contact->created_at->format('Y-m-d'),
            ];
        }

        // CSVを文字列に変換
        $output = fopen('php://temp', 'r+');
        foreach ($csvData as $line) {
            fputcsv($output, $line);
        }
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        // CSVをレスポンスとして返す
        $filename = 'contacts_' . date('Ymd_His') . '.csv';

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
