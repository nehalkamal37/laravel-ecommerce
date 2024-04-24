@extends('dash.app')
@section('title','admin dashboard')
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
    <a class="btn btn-info" href="{{ route('dashboard.users.create')}}">Add User</a>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table  
                     class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>email</th>
                                <th>role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$loop->index +1 }}</td>
                                
                                <td>{{ $d->name}}</td>
                                

                                <td>{{ $d->email}}</td>
                                <td>
                                    @if($d->hasRole('admin|user|super_admin'))
                                    @foreach($d->roles as $role)
                                    {{ $role->display_name ?? 'none'}}
@endforeach
@else
no role by laratrust but this user is {{$d->role}}
@endif


</td>
                                <td>
                                    <a href="{{ route('dashboard.users.edit',$d->id)}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                                  <form action="{{ route('dashboard.users.destroy',$d->id)}}" method="post">
                                  @csrf   @method('delete')
                                    <button  data-toggle="tooltip" data-original-title="Close">
                                         <i class="icon-trash txt-danger"></i> </button>
                                  </form>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {{ $data->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>    </div>
</div>
</section>



@endsection