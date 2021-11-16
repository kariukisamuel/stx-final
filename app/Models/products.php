<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_price',
        'product_image',
        'product_name',
        'product_description',
        'product_slug'
    ];
}
