@extends('dash.app')
@section('title','edit categories')
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
                <form action="{{ route('dashboard.categories.update',$category->id)}}" 
                    enctype="multipart/form-data" method="post" style="width: 1000px;margin-left:277px;"  >
                   @csrf
                   @method('put')
                   <img src="{{ asset('uploads/category/'.$category->category_image)}}" id="img_prv" width="222px" height="222px" alt="">

                    <div class="form-group">
                        <label for="username">name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                          
<input name="name" class="form-control" value="{{ old('name',$category->name)}}" id="username"
 placeholder="Username" type="text">
                        

                    </div>
                    </div>
                    @error('name')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                    </div>
                    @enderror  
                    <div class="form-group">
                        <label for="subtitle">Sub title</label>
                        <input name="subtitle" class="form-control" value="{{ old('subtitle',$category->subtitle)}}"  class="form-control" id="subtitle" placeholder="you@example.com" type="subtitle">
                    </div>
                    @error('subtitle')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  

                    <div class="form-group">
                        <label for="subtitle">Image</label>
                        <input  class="form-control" name="category_image" class="form-control" 
 value="{{ old('category_image',$category->category_image)}}" onchange="showPreview(event)" 
  id="category_image" placeholder="Password" type="file">
                    </div>

@error('category_image')
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
                   

                  

                    <hr>
                    <button class="btn btn-primary" type="submit">edit</button>
                </form>
            </div>
        </div>


    </div>
</div>


@endsection