<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'writer_id',
        'is_active',
        'description',
        'image',
        'slug'
    ];

    //writer
    public function writer(){
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }
}
