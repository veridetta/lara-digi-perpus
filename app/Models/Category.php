<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];
    protected static function booted()
    {
        parent::booted();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
