<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_branch_id',
        'to_branch_id',
        'created_by',
        'custom_counter',
        'driver_name',
        'driver_phone',
        'car_number',
        'chalan_note',
    ];

    public function fromBranch(){
        return $this->belongsTo(Branch::class, 'from_branch_id', 'id');
    }

    public function toBranch(){
        return $this->belongsTo(Branch::class, 'to_branch_id', 'id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class, 'chalan_id', 'id');
    }

    // if user is deleted than auto delete depended data
    public static function boot() {
        parent::boot();
        static::deleting(function($chalan) {
            $chalan->invoices()->update(['chalan_id' => null]);
        });
    }
}
