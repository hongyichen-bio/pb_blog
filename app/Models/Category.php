<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allRelatedProducts()
    {
        return Product::whereIn(
            'category_id',
            $this->getAllRelatedIds()
        )->get();
    }

    // 遞迴
    public function getAllRelatedIds()
    {
        $categoryIds = [$this->id];
        foreach ($this->children as $child) {
            $categoryIds = array_merge(
                $categoryIds,
                $child->getAllRelatedIds()
            );
        }
        return $categoryIds;
    }

}
