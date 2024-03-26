<?php

namespace App\Models\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    public $translationModel =SettingsTranslation::class;
    protected $fillable = [ 'logo','favicon'];
    public $translatedAttributes = ['name','text','title','seo_key'];

}
