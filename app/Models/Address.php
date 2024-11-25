<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Address extends Model
{
    use HasFactory, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address_title',
        'address_type',
        'contact_person_name',
        'mobile_number',
        'email',
        'country',
        'city',
        'location',
        'street',
        'postal_code',
        'additional_code',
        'building_name',
        'building_no',
        'floor_no',
        'unit_no',
        'notes',
    ];
}
