<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table='events';
    // protected $softDelete = true;
    protected $fillable = [
        'name',
        'slug',
        'featured_image',
        'description',
        'gallery',
        'event_date',
        'address',
        'type',
        'door_dontation',
        'vip_dontation',
        'vip_perk',
        'charity',
        'cost_of_vendor',
        'vendor_space_available',
        'area',
        'height',
        'capacity',
        'ATM_on_site',
        'tickiting_number',
        'vendor_number',
        'user_number',
        'website_link',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'status',
        'user_id',
    ];

    public function organizer(){
        return $this->hasOne(User::class,'id', 'user_id' );
    }
    public function vendors()
    {
        return $this->belongsToMany(User::class, 'vendors', 'event_id', 'user_id');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'event_amenities', 'event_id', 'amenity_id');
    }
}
