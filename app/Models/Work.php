<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    // Relationship to author
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    // Relationship to books
    public function books()
    {
        return $this->hasMany(Book::class, 'work_id');
    }
}