<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sponsor extends Model
{
    use HasFactory;
    protected $table='sponsors';
    // protected $softDelete = true;
    protected $fillable = [
        'name',
        'featured_image',
        'order',
    ];
}
