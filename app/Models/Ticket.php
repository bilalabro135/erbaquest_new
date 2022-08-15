<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'total',
        'price',
        'qty',
        'discount_code',
        'discount_percentage',
        'max_utilization',
        'start_date',
        'end_date',
        'vip_ticket',
        'total_vip',
        'vip_ticket_price',
        'user_qty',
        'status'
    ];
}
