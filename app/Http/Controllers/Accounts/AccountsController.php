<?php

namespace App\Http\Controllers\Accounts;

use Excel;
use Session;
use App\User;
use App\Offices;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users   = User::withTrashed()->get();
        $offices = Offices::orderBy('office_name', 'ASC')->get();
        return view('accounts.index', compact('users', 'offices'));
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
        //
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
    public function destroy(User $account)
    {
        if ( $account->delete() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Account successfully removed!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('accounts/');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id); 

        if ( $user->restore() )
        {
            $toastr = Session::flash('toastr', [ 
                [
                    'heading' => 'Success',
                    'text'    => 'Account successfully restored!', 
                    'icon'    => 'success', 
                ],
            ]);
        }

        return redirect('accounts/');
    }

    /**
    * Import file
    */
    public function importUserFile(Request $request)
    {
        if ( $request->hasFile('import_file') ) {

            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path)->get();
            $role = Role::where('name', 'Staff')->firstOrFail();

            if ( $data->count() ) {

                foreach ($data as $key => $value) {

                    $office  = Offices::where('acronym', $value->office)->firstOrFail();
                    $users = [
                        [
                            'username'   => $value->username,
                            'password'   => bcrypt('dostcaraga'),
                            'lastname'   => ucfirst(strtolower($value->lastname)),
                            'firstname'  => ucfirst(strtolower($value->firstname)),
                            'middlename' => ucfirst(strtolower($value->middlename)),
                            'sex'        => $value->sex == 'male' ? 0 : 1,
                            'birthday'   => date("Y-m-d", strtotime( $value->birthday )),
                            'address'    => $value->address,
                            'email'      => $value->email,
                            'mobile'     => $value->mobile,
                            'office_id'  => $office->id,
                            'position'   => $value->position,
                            '_isActive'  => $value->active ?: 0,
                            '_isAdmin'   => 0,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ],
                    ];

                    foreach ($users as $user) {
                        $u = User::create($user);
                        $u->roles()->sync($role);
                    }
                }

                $toastr = Session::flash('toastr', [ 
                    [
                        'heading' => 'Success',
                        'text'    => 'Users successfully imported in the database!', 
                        'icon'    => 'success', 
                    ],
                ]);

            } else {
                $toastr = Session::flash('toastr', [ 
                    [
                        'heading' => 'Warning',
                        'text'    => 'File is blank and cannot be imported!', 
                        'icon'    => 'warning', 
                    ],
                ]);
            }

        } else {
            Session::put('error', 'No file to be imported!');
            $toastr = Session::flash('toastr', [ 
                    [
                        'heading' => 'Error',
                        'text'    => 'Error importing file!', 
                        'icon'    => 'error', 
                    ],
                ]);
        }

        return back();
    }

    /**
    * Download csv file
    */
    public function downloadTemplateFile($type = 'csv')
    {
        $header[] = [
            'username', 'lastname', 'firstname',
            'middlename', 'sex', 'birthday',
            'address', 'email', 'mobile',
            'office', 'position', 'active'
        ];

        $header[] = [
            'jtcruz', 'Cruz', 'Juan',
            'Tamad', 'male', '12/31/2018',
            'P5 Ampayon, Butuan City', 'juantamadcruz@google.com', '09091234567',
            'ORD', 'SRS II', '1', '<= remove this sample row',
        ];

        return Excel::create('import_user_template', function($excel) use ($header) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Import User Template');
            $excel->setDescription('template for importing user accounts to the database');

            // Build the spreadsheet, passing in the header array
            $excel->sheet('sheet1', function($sheet) use ($header)
            {
                $sheet->fromArray($header, null, 'A1', false, false);
            });

        })->download($type);
    }
}
