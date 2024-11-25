<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class OrderItem extends Model
{
    use HasFactory, HasApiTokens;
    /*
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'product_id',
       'order_id',
       'design_id',
       'category_id',
       'subcategory_id',
       'quantity',
       'unit_price',
       'size',
       'side',
       'note',
       'days'
   ];

   public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'design_id');
    }

    public function products() 
    {
        return $this->hasMany(Product::class);
    }
}

