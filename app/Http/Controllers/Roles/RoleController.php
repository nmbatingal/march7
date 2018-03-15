<?php

namespace App\Http\Controllers\Roles;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('accounts.roles.roles', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
                'name'=>'required|unique:roles',
                'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $permissions = $request['permissions'];
        $role->save();

        //Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 
 
            //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first(); 
            $role->givePermissionTo($p);
        }

        /*$toastr = Session::flash('test', [ 
            [
                'heading' => 'Success',
                'text'    => 'Role <u>'. $role->name.'</u> successfully added!', 
                'icon'    => 'success', 
            ],
        ]);*/

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
