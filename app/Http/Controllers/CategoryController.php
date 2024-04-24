<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Image;
//use Intervention\Image\Drivers\Gd\Driver;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data=Category::all();
        
        return view('dash.categories.all',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      //  $roles=Role::all();
        
        return view('dash.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
'name'=> 'required|string|unique:categories|max:255|regex:/^[\pL\s\-]+$/u',
'subtitle'=> 'required|string|max:333',
'category_image'=> 'required|image|mimes:png,jpg,svg,jpeg|max:2048' //= 2 mega
        ]);

$requested_data=$request->except('category_image');
if($request->file('category_image'))
{

$catimg=uniqid().$request->file('category_image')->getClientOriginalName();
Image::make($request->file('category_image'))->resize(442,null,function($constraint){
$constraint->aspectRatio();
})->save(public_path('uploads/category/'.$catimg));

$requested_data['category_image']=$catimg;

}    
Category::create($requested_data);

return to_route('dashboard.categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('dash.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $request->validate([
  'name'=> 'required|string|unique:categories,name,'.$category->id.'|max:255|regex:/^[\pL\s\-]+$/u',
  'subtitle'=> 'required|string|max:333',
            'category_image'=> 'image|mimes:png,jpg,svg,jpeg|max:2048' //= 2 mega
                    ]);
            
            $requested_data=$request->except('category_image');
            if($request->file('category_image')){
            
            $catimg=uniqid().$request->file('category_image')->getClientOriginalName();
            /*$img= $catimg->store('/','public');
            file::create([
                'img_path'=>$img,
            ]);*/
            
            
            Image::make($request->file('category_image'))->resize(442,null,function($constraint){
            $constraint->aspectRatio();
            })->save(public_path('uploads/category/'.$catimg));
if($category->category_image != null){
        unlink(public_path('uploads/category/'.$category->category_image)); //this one works
}
    // Storage::disk('public_uploads')->delete("category/$category->category_image");
            $requested_data['category_image']=$catimg;
            
            }    
            $category->update($requested_data);
            
            return to_route('dashboard.categories.index')->with('success','category updated');
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        unlink(public_path('uploads/category/'.$category->category_image)); //this one works
        $category->delete();
            
        return to_route('dashboard.categories.index')->with('success','category deleted');
        
    }
}
