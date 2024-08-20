<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'discount_type', 'discount_value', 'usage_limit', 'start_date', 'end_date'
    ];

    public function calculateDiscount($totalAmount)
    {
        if ($this->discount_type == 'percentage') {
            return $totalAmount * ($this->discount_value / 100);
        } elseif ($this->discount_type == 'fixed') {
            return $this->discount_value;
        }

        return 0;
    }

    public function isValid()
    {
        $currentDate = now();
        return $this->start_date <= $currentDate && $this->end_date >= $currentDate && $this->usage_limit > 0;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_user');
    }
}
