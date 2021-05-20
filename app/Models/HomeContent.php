<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'serial',
        'is_active'
    ];

    //homeContentFaqs
    public function homeContentFaqs(){
        return $this->hasMany(HomeContentFaq::class, 'home_content_id', 'id');
    }

}
