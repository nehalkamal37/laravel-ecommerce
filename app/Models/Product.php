<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name_ar','name_en','description_ar','price','description_en','category_id','product_image'
    ];
    public function category(){
        return $this->belongsTo(category::class);
    }

}
