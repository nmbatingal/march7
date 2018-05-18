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
            $role = Role::where('name', 'System Administrator')->firstOrFail();

            if ( $data->count() ) {

                foreach ($data as $key => $value) {

                    $office  = Offices::where('acronym', $value->office)->firstOrFail();
                    $users = [
                        [
                            'username'   => $value->username,
                            'password'   => bcrypt('dostcaraga'),
                            'lastname'   => $value->lastname,
                            'firstname'  => $value->firstname,
                            'middlename' => $value->middlename,
                            'sex'        => $value->sex == 'male' ? 0 : 1,
                            'birthday'   => date("Y-m-d", strtotime( $value->birthday )),
                            // 'address'    => NULL,
                            'email'      => $value->email,
                            // 'mobile'     => NULL,
                            'office_id'  => $office->id,
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

                Session::put('success', 'Your file successfully import in database!');

            } else {
                Session::put('warning', 'File is blank and cannot be imported! Nothing saved in the database.');
            }

        } else {
            Session::put('error', 'No file to be imported!');
        }

        return back();
    }
}
