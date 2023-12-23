<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Language;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PostsTrans extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',  
        'content',
        'main_id',
        'lang_id', 
          
    ];
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'main_id')->withDefault();
    }
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id')->withDefault();
    }
}
