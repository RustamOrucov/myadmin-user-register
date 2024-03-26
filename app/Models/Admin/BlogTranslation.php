<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasFactory;
    public $fillable = ['name','slug','text','seo_title','seo_desc','seo_key'];
    public $timestamps = false;
}
