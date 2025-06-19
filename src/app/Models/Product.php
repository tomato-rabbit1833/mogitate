<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 複数代入可能な属性
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
    ];

    // seasonsとのリレーション（多対多）
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}