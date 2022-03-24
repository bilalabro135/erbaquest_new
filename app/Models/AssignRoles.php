<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignRoles extends Model
{
    use HasFactory; 
    protected $table='assigned_roles';

    protected $fillable = [
        'entity_id',
    ];
}
