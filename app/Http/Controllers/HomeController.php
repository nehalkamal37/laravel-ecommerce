<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $categories=Category::all();
        $products=Product::with('category')->get();
        return view('front.index',compact('categories','products'));
    }
}
