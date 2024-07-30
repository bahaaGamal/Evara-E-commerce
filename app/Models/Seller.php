<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'address',
        'cover_image',
        'profile_image',
        'manager_name',
        'email',
        'phone',
        'country',
        'postal_code',
        'status',
    ];
}
