<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 35; $i++) {
            $data[] = [
                'first_name' => '山田',
                'last_name' => '太郎',
                'gender' => 1,
                'email' => "taro{$i}@example.com", // 一意にする必要がある
                'tel1' => '090',
                'tel2' => '1234',
                'tel3' => '5678',
                'address' => '東京都新宿区1-1-1',
                'building' => '山田ビル101',
                'categories' => '商品のお届けについて',
                'detail' => '商品が届きません。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('contacts')->insert($data);
    }
}
