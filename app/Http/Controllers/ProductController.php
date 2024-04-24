<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();
        return view('dash.products.all',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('dash.products.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name_ar'=> 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'name_en'=> 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'price'=> 'required|max:33',
            'category_id'=>'sometimes',
            'description_ar'=> 'required|max:955',
            'description_en'=> 'required|max:955',
            'product_image'=> 'image|mimes:png,jpg,svg,jpeg|max:2048' //= 2 mega
                    ]);
            
            $requested_data=$request->except('product_image');
            if($request->file('product_image'))
            {
            $catimg=uniqid().$request->file('product_image')->getClientOriginalName();
            Image::make($request->file('product_image'))->resize(442,null,function($constraint){
            $constraint->aspectRatio();
            })->save(public_path('uploads/product/'.$catimg));
            
            $requested_data['product_image']=$catimg;
            
            }    
            Product::create($requested_data);
            
            return to_route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
              $categories=Category::all();

        return view('dash.products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar'=> 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'name_en'=> 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'price'=> 'required|max:33',
            'category_id'=>'sometimes',
            'description_ar'=> 'required|max:955',
            'description_en'=> 'required|max:955',
            'product_image'=> 'image|mimes:png,jpg,svg,jpeg|max:2048' //= 2 mega
                    ]);
                      
                      $requested_data=$request->except('product_image');
                      if($request->file('product_image')){
                      if($product->product_image != 'product.png'){
                        unlink(public_path('uploads/product/'.$product->product_image)); //this one works
                }
                      
                      
                      $catimg=uniqid().$request->file('product_image')->getClientOriginalName();
                      
                      Image::make($request->file('product_image'))->resize(442,null,function($constraint){
                      $constraint->aspectRatio();
                      })->save(public_path('uploads/product/'.$catimg));
         
              // Storage::disk('public_uploads')->delete("product/$product->product_image");
                      $requested_data['product_image']=$catimg;
                      
                      }    
                      $product->update($requested_data);
                      
                      return to_route('dashboard.products.index')->with('success','product updated');
                  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->product_image != 'product.png'){
        unlink(public_path('uploads/product/'.$product->product_image)); //this one works
        }
        $product->delete();
            
        return to_route('dashboard.products.index')->with('success','product deleted');
        
    }
}
