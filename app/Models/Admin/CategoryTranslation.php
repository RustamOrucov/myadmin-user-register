<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;
    public $fillable = ['name','slug','desc','seo_title','seo_desc','seo_key'];
    public $timestamps = false;
}
