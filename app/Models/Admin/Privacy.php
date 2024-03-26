<?php

namespace App\Models\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privacy extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    public $translationModel =PrivacyTranslation::class;
    protected $guarded = [];
    public $translatedAttributes = ['text'];
}
