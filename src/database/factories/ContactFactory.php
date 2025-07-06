<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $faker = FakerFactory::create('ja_JP');

        return [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'gender' => $faker->numberBetween(1, 3),
            'email' => $faker->unique()->safeEmail(),
            'tel1' => $faker->numberBetween(100, 999),
            'tel2' => $faker->numberBetween(1000, 9999),
            'tel3' => $faker->numberBetween(1000, 9999),
            'address' => $faker->address(),
            'building' => $faker->optional()->secondaryAddress(),
            'categories' => $faker->randomElement([
                '商品のお届けについて',
                '商品の交換について',
                '商品トラブル',
                'ショップへのお問い合わせ',
                'その他'
            ]),
            'detail' => $faker->realText(100),
        ];
    }
}
