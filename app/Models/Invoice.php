<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'sender_phone',
        'barcode',
        'status',
        'chalan_id',
        'creator_id',
        'updater_id',
        'receiver_id',
        'from_branch_id',
        'to_branch_id',
        'sender_name',
        'description',
        'quantity',
        'price',
        'home',
        'labour',
        'paid',
        'condition_amount',
        'condition_charge',
        'custom_counter',
        'creator_ip',
        'creator_browser',
        'creator_device',
        'creator_os',
        'creator_location',
        'last_visitor_ip',
        'last_visitor_browser',
        'last_visitor_device',
        'last_visitor_os',
        'last_visitor_location',
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

    public function updater(){
        return $this->belongsTo(User::class, 'updater_id', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
