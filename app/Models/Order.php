<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name', 'address', 'contact_number', 'user_id', 'cake_name', 
        'cake_id', 'price', 'image', 'payment_status', 'delivery_status'
    ];

}
