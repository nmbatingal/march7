<?php

use App\Offices;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$office = Offices::where('acronym', '=', 'TSS')->firstOrFail();
        $users = [
            [
                'username'   => 'admin',
                'password'   => bcrypt('dostcaraga'),
                'lastname'   => 'account',
                'firstname'  => 'admin',
                'sex'	     => 0,
                'birthday'   => date("Y-m-d"),
                'email'	     => 'admindost@caraga.com',
                'office_id'  => $office->id,
                'position'   => 'System Administrator',
                '_isActive'  => 1,
                '_isAdmin'   => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
