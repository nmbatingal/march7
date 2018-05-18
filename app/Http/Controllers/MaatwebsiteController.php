<?php

namespace App\Http\Controllers;

use DB;
use Excel;
use Input;
use Session;
use App\User;
use App\Offices;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class MaatwebsiteController extends Controller
{
    public function importExport()
    {
        return view('importExport');
    }

    public function excel()
    {
        $payments = User::orderBy('firstname', 'ASC')
                    ->select(
                        'id',
                        DB::raw("concat(firstname, ' ', lastname) as fullname"),
                        'email',
                        'created_at')
                    ->get();

        $paymentsArray = [];
        $paymentsArray[] = ['id', 'customer','email','created_at'];

        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        \Excel::create('payments', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');

        return $payments;
    }

    public function downloadExcel($type)
    {
        // $data = Post::get()->toArray();
        $data = User::orderBy('firstname', 'ASC')
                    ->select(
                        'id',
                        DB::raw("concat(firstname, ' ', lastname) as fullname"),
                        'email',
                        'created_at')
                    ->get();

        $dataArray = [];
        $dataArray[] = ['id', 'customer','email','created_at'];
        foreach ($data as $row_data) {
            $dataArray[] = $row_data->toArray();
        }

        return Excel::create('laravelcode', function($excel) use ($dataArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Laravel Code');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('laravel file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($dataArray)
            {
                $sheet->fromArray($dataArray, null, 'A1', false, false);
            });

        })->download($type);
    }

    public function importExcel(Request $request)
    {
        if ( $request->hasFile('import_file') ) {

            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path)->get();

            if($data->count()) {

                foreach ($data as $key => $value) {

                    $user = new User;
                    $user->username     = $value->username;
                    $user->lastname     = $value->lastname;
                    $user->firstname    = $value->firstname;
                    $user->middlename   = $value->middlename;
                    $user->birthday     = $value->birthday;
                    $user->email        = $value->email;
                    $user->position     = $value->position;

                    $role  = Role::where('name', 'System Administrator')->firstOrFail();
                    $users = [
                        [
                            'username'   => $value->username,
                            'password'   => bcrypt('dostcaraga'),
                            'lastname'   => $value->lastname,
                            'firstname'  => $value->firstname,
                            'middlename' => $value->middlename,
                            'sex'        => 0,
                            'birthday'   => date("Y-m-d", strtotime( $value->birthday )),
                            // 'address'    => NULL,
                            'email'      => $value->email,
                            // 'mobile'     => NULL,
                            // 'office_id'  => $office->id,
                            'position'   => $value->position,
                            '_isActive'  => 0,
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
            }

            /*Excel::load($request->file('import_file')->getRealPath(), function ($reader) {

                foreach ($reader->toArray() as $key => $row) {
                    $data['title'] = $row['title'];
                    $data['description'] = $row['description'];

                    if(!empty($data)) {
                        DB::table('post')->insert($data);
                    }
                }
            });*/

        }

        Session::put('success', 'Your file successfully import in database!!!');

        return back();
        // return dd($collection);
    }
}
