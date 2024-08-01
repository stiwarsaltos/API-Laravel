<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
class Document extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'documents';
    protected $fillable = [
        'date', 'num', 'client', 'quantityProducts', 'total'
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
