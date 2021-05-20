<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chalan extends Model
{
    use HasFactory;

    public function fromBranch(){
        return $this->belongsTo(Branch::class, 'from_branch_id', 'id');
    }

    public function toBranch(){
        return $this->belongsTo(Branch::class, 'to_branch_id', 'id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class, 'chalan_id', 'id');
    }
}
