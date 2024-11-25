<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Product extends Model
{
    use HasFactory, HasApiTokens;
    /*
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'name',
       'price',
       'images',
       'size',
       'side',
       'material',
       'category_id',
       'subcategory_id'
   ];


    // Define the relationship with Attributes
    public function attributes()
    {
        return $this->hasMany(Attributes::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
   
}
