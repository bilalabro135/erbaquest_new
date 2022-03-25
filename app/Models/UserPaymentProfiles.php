<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentProfiles extends Model
{
    use HasFactory;

    protected $table='user_payment_profiles';
    protected $fillable = [
        'user_id',
        'payment_profile_id',
    ];
}
