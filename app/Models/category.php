<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','subtitle','category_image'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
