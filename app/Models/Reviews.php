<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table='review';
    // protected $softDelete = true;
    protected $fillable = [
        'rel_id',
        'user_id',
        'type',
        'speed_rating',
        'quality_rating',
        'price_rating',
        'featured_image',
        'comment',
        'name',
        'email',
        'website',
    ];
}
