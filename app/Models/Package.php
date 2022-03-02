<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table='packages';

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'price',
        'reccuring_every',
        'duration',
        'product_id',
        'plan_id',
    ];
}
