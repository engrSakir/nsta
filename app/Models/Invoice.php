<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];
    public function fromBranch(){
        return $this->belongsTo(Branch::class, 'from_branch_id', 'id');
    }

    public function toBranch(){
        return $this->belongsTo(Branch::class, 'to_branch_id', 'id');
    }

    public function chalan(){
        return $this->belongsTo(Chalan::class, 'chalan_id', 'id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }



}
