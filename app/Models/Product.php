<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete; 

class Product extends Model
{
    use HasFactory;
    use SoftDelete;

    protected $guarded = ['delete_at'];
    
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'status',
        'warranty',
        'cart_id'
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class);
    }
}
