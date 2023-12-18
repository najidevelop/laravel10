<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'desc',
        'parent_id',
        'sequence', 
        'status',
        'createuserid',
        'updateuserid',       
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function categories_trans(): HasMany
    {
        return $this->hasMany(CategoriesTrans::class, 'main_id');
    }
   
}
