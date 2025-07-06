<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
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
    ];

    public function getGenderLabelAttribute()
    {
        return $this->gender == 1 ? '男性' : '女性' ; 'その他';
    }
}
