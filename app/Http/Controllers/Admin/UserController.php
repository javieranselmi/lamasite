<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;


class UserController extends AdminController
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',['users'=>$users]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',['roles'=>$roles]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name'                  => 'required|max:120|alpha_dash',
                'email'                 => 'required|email|unique:users',
                'roles'                 => 'required|exists:roles,id',
                'password'              => 'required|confirmed|min:4'
            ]
        );
        $email          = $request['email'];
        $name           = $request['name'];
        $password       = Hash::make($request['password']);
        $user = new User;
        $user->email    = $email;
        $user->name     = $name;
        $user->password = $password;
        $user->save();

        //attach roles
        $user->roles()->sync([$request->input('roles')]);
        return redirect()->route('users.index')->with(['status' => 'success', 'message' => 'Usuario creado!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.view',['user' => $user]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view ('admin.users.edit',['user' => $user, 'roles' => $roles]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
                'name'                  => 'required|max:120|alpha_dash',
                'email'                 => ['required','email',
                                            Rule::unique('users')->ignore($user->id)
                                        ],
                'roles'                 => 'required|exists:roles,id',
                'password'              => 'required|confirmed|min:4'
            ]
        );
        $email          = $request['email'];
        $name           = $request['name'];
        if ($request['password'] != $user->password) {
            $password       = Hash::make($request['password']);
            $user->password = $password;
        }
        $user->email    = $email;
        $user->name     = $name;
        $user->save();

        //attach roles
        $user->roles()->sync([$request->input('roles')]);
        return redirect()->route('users.index')->with(['status' => 'success', 'message' => 'Usuario editado!']);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->ajax()) {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => "Usuario Borrado"]);
        }
        abort(400);
        //
    }
}
