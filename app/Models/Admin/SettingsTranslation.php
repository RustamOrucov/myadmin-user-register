<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsTranslation extends Model
{
    use HasFactory;
    public $fillable = ['name','text','title','seo_key'];
    public $timestamps = false;
}
