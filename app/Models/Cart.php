<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $guarded=[];


    protected static function booted(){
        // static::observe(CartObserver::class)    this if we made an observer class
        static::creating(function (Cart $cart){
            $cart->id =Str::uuid();

        });
    }

public function user(){
   return $this->belongsTo(User::class)->withDefault([
    'name'=>'not logged yet',
   ]);

}
   public function product(){
    return $this->belongsTo(Product::class)->withDefault([
        'name'=>'not added yet',
       ]);
} 












}
