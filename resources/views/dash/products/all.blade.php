@extends('dash.app')
@section('title','All products')
@include('sweetalert::alert')

@section('content')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
    </ol>
</nav>

<div class="row">
    <div class="col-xl-12">


<h5 class="hk-sec-title">Striped Table</h5>
<section style="width: 1000px;margin-left:266px;"  class="hk-sec-wrapper">
                            @if(Session('success'))

<div class="alert alert-success" role="alert">
{{Session('success')}}</div>

                            @endif
    <p class="mb-40">Add class <code>.table-striped</code> in table tag.</p>
    <a class="btn btn-info" href="{{ route('dashboard.products.create')}}">Add New</a>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table  
                     class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name ar</th>     
                               <th>name en</th>

                                <th>price</th>
                                <th>category</th>
                                <th>description ar</th>
                                <th>description en</th>

                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->index +1 }}</td>
                                
                                <td>{{ $product->name_ar}}</td>
                                <td>{{ $product->name_en}}</td>

                                <td>{{ $product->price}}</td>
                                <td>{{ $product->category->name}}</td>
                                <td>{!! Str::limit($product->description_ar,22) !!}</td>
                                <td>{!! $product->description_en !!}</td>

                                <td>
<img src="{{ asset('uploads/product/'.$product->product_image)}}" width="133px" height="222px" alt="">
</td>
                                <td>
                                    <a href="{{ route('dashboard.products.edit',$product->id)}}" class="mr-25" products-toggle="tooltip" products-original-title="Edit"> <i class="icon-pencil"></i> </a>
     <form action="{{ route('dashboard.products.destroy',$product->id)}}" method="post">
                                  @csrf   @method('delete')
                                    <button  products-toggle="tooltip" products-original-title="Close">
                                         <i class="icon-trash txt-danger"></i> </button>
                                  </form>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    </div>
</div>
</section>



@endsection