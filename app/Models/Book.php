<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'title', 'category_id', 'user_id', 'description', 'amount', 'pdf', 'cover', 'slug'
    ];

    //boot slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($book) {
            $book->slug = Str::slug($book->title);
        });
    }

    //relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
