<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartModelRepository;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        // $repo= app::make('cart');
         $items =$cart->get();
         $product=Product::all();
         return view('front.all_cart',compact('items','product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CartRepository $cart)
    {
        $request->validate([
            'product_id'=>'required|int|exists:products,id',
            'quantity'=>'nullable|int|min:1',
            ''
        ]);
           $product=Product::findOrFail($request->product_id);
           $cart->add($product,$request->quantity);
 return to_route('carts.index');


    }

    /**
     * Display the specified resource.
     */
   
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id,CartRepository $cart)
    {
        $request->validate([
            'product_id'=>'required|int|exists:products,id',
            'quantity'=>'nullable|int|min:1',
            ''
        ]);         
         //  $repo= app::make('cart');

           $product=Product::findOrFail($request->product_id);
           $cart->update($product,$request->quantity);
 return to_route('carts.index');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( CartRepository $cart,$id)
    {
       // $repo= app::make('cart');
        $cart->delete($id);
        return to_route('carts.index');

    }
}
