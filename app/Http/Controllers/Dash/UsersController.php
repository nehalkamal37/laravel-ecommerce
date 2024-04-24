<?php

namespace App\Http\Controllers\Dash;

use App\Models\User;
use Laratrust\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        if($user->role==('super_admin')){
            $data =User::whereHasRole(['admin','user'])->paginate();

        }else{
        $data=User::paginate();
        }
        return view('dash.users.all',compact('data'));
    
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
        
        return view('dash.users.create',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string|max:55',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|max:16',
            'role'=> 'required|'.Rule::in(['user','admin','super_admin'])
        ]);

       $newuser= User::create($request->all());
       $newuser->addRole($request->role);
       $newuser->update(['role'=>$request->role]);
       Alert::toast('user added successfully ', 'success');
       return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles=Role::all();
        
        return view('dash.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated=$request->validate([
            'name'=>'required|string|max:55',
            'email'=>'required|email|', 
            //.Role::unique('users')->ignore($user->id),
            'password'=>'required|min:6|max:66',
            'role'=> 'required|'.Rule::in(['user','admin','super_admin'])
        ]);
        $requetdata=$request->except('password','_token');
        if(!Hash::check($request->password,$user->password)){
            $requetdata['password']=Hash::make($request->password);
        }
        $user->update($requetdata);
        $rolechoosen=Role::where('name',$request->input('role'))->first();

        $user->syncRoles([$rolechoosen->id]);
        //$user->addRole($request->role);
        return to_route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        $user->removeRoles([$user->role]);
        return to_route('dashboard.users.index');

    }
}
