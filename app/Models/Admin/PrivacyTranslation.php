<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyTranslation extends Model
{
    use HasFactory;
    public $fillable = ['text'];
    public $timestamps = false;
}
