<?php

namespace App\Models\Admin;

use App\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    public $translationModel =BlogTranslation::class;
    protected $fillable = [ 'status','view_count','like_count','img','publish_date','read_time','order','category_id','user_id'];
    public $translatedAttributes = ['name','slug','text','seo_title','seo_desc','seo_key'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function User():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }


}
