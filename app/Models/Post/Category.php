<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'desc',
        'parent_id',
        'sequence', 
    ];
}
