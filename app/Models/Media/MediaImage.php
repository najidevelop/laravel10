<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'caption',
        'desc',
        'url',         
        'extention',
    ];
}
