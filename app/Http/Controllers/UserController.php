<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\Jabatan;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(20);
        return view(
            'users.index',
            [
                'title' => 'Users',
                'subtitle' => 'Show All'
            ],
            compact('data')
        )
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        $heads = User::all();
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', ['title' => 'Users', 'subtitle' => 'Create'], compact('roles', 'positions', 'heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'max:128', 'min:5'],
            'nrp'           => ['required', 'min:10', 'max:14', 'unique:users'],
            'email'         => ['required', 'email', 'unique:users,email', 'regex:/^[A-Za-z0-9\.]*@(uiii)[.](ac)[.](id)$/'],
            'roles'         => ['required'],
            'position_id'   => ['nullable', 'exists:positions,id'],
            'head_id'   => ['nullable', 'exists:users,id'],
        ]);

        $data['status'] = true;
        $password = '123456789';
        $data['password'] = Hash::make($password);

        $user = User::create($data);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'User ' . $request->name . ' Berhasil ditambahkan, password = ' . $password);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', [
            'title' => 'User',
            'subtitle' => 'Show'
        ], compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user       = User::find($id);
        $roles      = Role::pluck('name', 'name')->all();
        $userRole   = $user->roles->pluck('name', 'name')->all();
        $positions  = Position::all();
        $heads      = User::all();
        return view(
            'users.edit',
            [
                'title' => 'User',
                'subtitle' => 'Edit'
            ],
            compact('user', 'roles', 'userRole', 'positions', 'heads')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'          => ['required'],
            'nrp'           => ['required', 'min:10', 'max:14', 'unique:users,nrp,' . $id],
            'email'         => ['required', 'email', 'unique:users,email,' . $id, 'regex:/^[A-Za-z0-9\.]*@(uiii)[.](ac)[.](id)$/'],
            'password'      => ['confirmed'],
            'roles'         => ['required'],
            'position_id'   => ['nullable', 'exists:positions,id'],
            'head_id'       => ['nullable', 'exists:users,id'],
        ]);

        $data = $request->all();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, array('password'));
        }

        $user = User::find($id);
        $user->update($data);
        if ($user->getRoleNames()->first() != $request->roles) {
            $user->removeRole($user->getRoleNames()->first());
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')
            ->with('warning', 'User berhasil diperbarui');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:2048']
        ], [
            'file.required' => 'File wajib diisi'
        ]);

        Excel::import(new UserImport, $request->file('file'));
        return back();
    }

    public function export()
    {
        return Excel::download(new UserExport, 'User.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/users')->with('danger', 'User has been deleted!');
    }

    public function staff_list(Request $request)
    {
        $data = User::select('id', 'name')->role('Staff')->where('name', 'LIKE', "%{$request->input('query')}%")->get();
        return response()->json($data);
    }
}
