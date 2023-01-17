<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity', 'product_id', 'user_id'
    ];
    public function Product()
    {
        return $this->hasMany(Product::class);
    }
    public function User()
    {
        return $this->hasMany(User::class);
    }
}