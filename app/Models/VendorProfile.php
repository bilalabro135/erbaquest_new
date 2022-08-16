<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    use HasFactory;

    protected $table='vendor_profile';
    // protected $softDelete = true;
    protected $fillable = [
        'public_profile_name',
        'email',
        'website',
        'instagram',
        'facebook',
        'twitter',
        'youtube',
        'linkedin',
        'telegram',
        'discord',
        'featured_picture',
        'phone',
        'descreption',
        'user_id',
        'category_id',
    ];

}
