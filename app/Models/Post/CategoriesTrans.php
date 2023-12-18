<?php

namespace App\Models\Post;

use App\Models\Admin\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class CategoriesTrans extends Model
{
    use HasFactory;

   
public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'main_id')->withDefault();
    }
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id')->withDefault();
    }
}
