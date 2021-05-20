<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'short_title',
        'long_title',
        'short_description',
        'long_description',
        'is_active',
    ];

    //category
    public function category(){
        return $this->belongsTo(PortfolioCategory::class, 'category_id', 'id');
    }

     //images
     public function images(){
        return $this->hasMany(PortfolioImage::class, 'portfolio_id', 'id');
    }

}
