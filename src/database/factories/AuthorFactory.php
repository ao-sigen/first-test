<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(1, 3), // 1:男性, 2:女性, 3:その他
            'email' => $this->faker->unique()->safeEmail(),
            'tel1' => $this->faker->numberBetween(100, 999), // 3桁
            'tel2' => $this->faker->numberBetween(1000, 9999), // 4桁
            'tel3' => $this->faker->numberBetween(1000, 9999), // 4桁
            'address' => $this->faker->address(),
            'building' => $this->faker->optional()->secondaryAddress(), // NULLも許容
            'categories' => $this->faker->randomElement([
                '商品のお届けについて',
                '商品の交換について',
                '商品トラブル',
                'ショップへのお問い合わせ',
                'その他'
            ]),
            'detail' => $this->faker->realText(100),
        ];
    }
}
