@extends('dash.app')
@section('title','add users')
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
                <form action="{{ route('dashboard.users.store')}}" method="post" style="width: 1000px;margin-left:277px;"  >
                   @csrf
                   

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                          
<input name="name" class="form-control" value="{{ old('name')}}" id="username"
 placeholder="Username" type="text">
                        

                    </div>
                    </div>
                    @error('name')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                    </div>
                    @enderror  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" class="form-control" value="{{ old('email')}}"  class="form-control" id="email" placeholder="you@example.com" type="email">
                    </div>
                    @error('email')
                    <div class="alert alert-warning" role="alert">
                    {{$message}}
                      </div>
                    @enderror  

                    <div class="form-group">
                        <label for="email">Password</label>
                        <input class="form-control" name="password" class="form-control" value="{{ old('password')}}"  id="password" placeholder="Password" type="password">
                    </div>
@error('password')
<div class="alert alert-warning" role="alert">
{{$message}}
  </div>
@enderror  
                   

                    <div class="form-group">
                        <label for="input_tags">roles</label>
                        <select name="role" id="input_tags" class="form-control select2-hidden-accessible"
                          data-select2-id="input_tags" tabindex="-1" aria-hidden="true">
                          @foreach($roles as $role)
                            <option selected="selected" @selected($role->name ==old('role')) value="{{ $role->name}}" data-select2-id="3">{{ $role->display_name}}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <hr>
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>
            </div>
        </div>


    </div>
</div>


@endsection