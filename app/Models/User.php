<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'image',
        'name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'is_active',
        'company_id',
        'branch_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }


    public function invoices(){
        return $this->hasMany(Invoice::class, 'creator_id', 'id');
    }

    public function invoices_as_customer(){
        return $this->hasMany(Invoice::class, 'receiver_id', 'id');
    }

    public function getInvoiceAsCustomer(){
        return $this->hasMany(Invoice::class, 'receiver_id', 'id');
    }

    // if user is deleted than auto delete depended data
    public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            $user->invoices_as_customer()->delete();
        });
    }

}
