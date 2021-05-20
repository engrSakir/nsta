<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallToAction extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'action_name',
        'action_url',
        'is_active',
    ];
}
