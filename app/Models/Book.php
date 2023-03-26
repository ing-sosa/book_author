<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $filable = [
        'name', 'title', 'description', 'author_id', 'year_published', 'isbn'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
