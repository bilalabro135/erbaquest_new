<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGatewayProfiles extends Model
{
    use HasFactory;

    protected $table='user_gateway_profiles';
    protected $fillable = [
        'user_id',
        'profile_id',
    ];
}
