<?php

namespace App\Models\Admin;
use App\Models\Post\CategoriesTrans;
use App\Models\Post\PostsTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'notes',
        'sequence',
        'status', 
        'image',
'htmlcode',
    ];

    public function categories_trans(): HasMany
    {
        return $this->hasMany(CategoriesTrans::class, 'lang_id');
    }
    public function posts_trans(): HasMany
    {
        return $this->hasMany(postsTrans::class, 'lang_id');
    }
}
