<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //portfolios
    public function portfolios(){
        return $this->hasMany(Portfolio::class, 'category_id', 'id')->where('is_active', true);
    }
}
