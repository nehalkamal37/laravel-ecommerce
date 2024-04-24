@extends('dash.app')
@section('title','edit products')
@section('content')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
    </ol>
</nav>
<div class="row">
    <div class="col-x1-6">
        <div class="row">
            <div class="col-sm">
                <form action="{{ route('dashboard.products.update',$product->id)}}" 
                    enctype="multipart/form-data" method="post" style="width: 1000px;margin-left:277px;"  >
                   @csrf
                   @method('put')
                   <img src="{{ asset('uploads/product/'.$product->product_image)}}" id="img_prv" width="222px" height="222px" alt="">

                    <div class="form-group">
                        <label for="username">name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                          
<input name="name_ar" class="form-control" value="{{ old('name_ar',$product->name_ar)}}" id="username"
 placeholder="Username" type="text">
                        

                    </div>
                    </div>
                    @error('name_ar')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                    </div>
                    @enderror  

                    <div class="form-group">
                        <label for="name_en">name_en</label>
                        <input name="name_en" class="form-control" value="{{ old('name_en',$product->name_en)}}"  class="form-control" id="name_en" placeholder="you@example.com" type="name_en">
                    </div>
                    @error('name_en')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  

                    <div class="form-group">
                        <label for="">category</label>
                        <select name="category_id">
                            <option @selected($product->category_id = null) value=""> none</option>
@foreach($categories as $cat)

<option value="{{ $cat->id}}" @selected($product->category_id = $cat->id)>{{ $cat->name}} </option>

@endforeach
                        </select>
                    </div>
                    @error('category_id')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  

                    <div class="form-group">
                        <label for="">Price</label>
                       <input name="price" class="form-control" value="{{ old('price',$product->price)}}" 
                       class="form-control" id="" placeholder="price" type="text">
                    </div>
                    @error('price')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  


                    <div class="form-group">
                        <label for="email">description ar</label>
     <textarea name="description_ar" value="{{ old('description_ar',$product->description_ar)}}" class="txtdesc"></textarea>
                    </div>
                    @error('description_ar')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  


                    <div class="form-group">
                        <label for="email">description en</label>
     <textarea name="description_en" class="txtdesc" value="{{ old('description_en',$product->description_en)}}" ></textarea>

                    </div>
                    @error('description_en')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  

                    

                    <div class="form-group">
                        <label for="name_en">Image</label>
                        <input  class="form-control" name="product_image" class="form-control" 
 value="{{ old('product_image',$product->product_image)}}" onchange="showPreview(event)" 
  id="product_image" placeholder="Password" type="file">
                    </div>

@error('product_image')
<div class="alert alert-warning" role="alert">
{{$message}}
  </div>
@enderror  
<script>
    function showPreview(event){
        if(event.target.files.length >0){
            let src=URL.createObjectURL(event.target.files[0]);
            let prv=document.getElementById('img_prv');
            prv.src=src;
        }
    }
    </script> 
                   
                   <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
                   <script>

                       let txtarea=document.querySelectorAll('.txtdesc');

                       txtarea.forEach(desc => {           
                        ClassicEditor
                           .create(desc)
                               // document.querySelector( '.txtdesc' ) )
                           .catch( error => {
                               console.error( error );
                           } );
                   
                       });
                   </script>
                  

                    <hr>
                    <button class="btn btn-primary" type="submit">edit</button>
                </form>
            </div>
        </div>


    </div>
</div>


@endsection