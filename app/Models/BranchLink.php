<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_branch_id',
        'to_branch_id',
    ];

    public function fromBranch(){
        return $this->belongsTo(Branch::class, 'from_branch_id', 'id');
    }

    public function toBranch(){
        return $this->belongsTo(Branch::class, 'to_branch_id', 'id');
    }
}
