<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'email', 'phone_number', 'zip_code', 'notes', 'payment_type'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
