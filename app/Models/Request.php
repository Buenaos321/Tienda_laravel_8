<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete; 

class Request extends Model
{
    use HasFactory;
    use SoftDelete;

    protected $guarded = ['deleted_at'];

    protected $fillable =[
        'cart_id',
        'delivery_time'
    ];

    public function cart(){
        $this->hasOne(Cart::class);
    }
}
