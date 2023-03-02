<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'size',
        'price',
        'quantity'
    ];

    public function produc_images()
    {
        return $this->hasMany(ProducImage::class);
    }
}
