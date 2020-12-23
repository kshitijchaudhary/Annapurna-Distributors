<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'img',
        'name',
        'quantity',
        'price',
        'desc',
        'subcat_id', 
    ];
} 