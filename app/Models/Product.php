<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['title', 'price',  'filename', 'brand_name', 'category_name'];
    use HasFactory;

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'aid');
    }
    function category_name()
    {
        return @$this->category->name ?: 'Default';
    }
}
