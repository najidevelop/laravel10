<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Post extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'sequence', 
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
}
