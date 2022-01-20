<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'idcategory'
    ];

    public function Category() {
        return $this->belongsTo('App\Models\Category', 'idcategory', 'id');
    }
}
