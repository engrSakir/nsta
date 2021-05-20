<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'portfoilo_id',
    ];

    //portfolio
    public function portfolio(){
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }

}
