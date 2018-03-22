<?php

use App\User;
use App\Offices;
use Spatie\Permission\Models\Role;
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
        $roles  = Role::where('name', 'System Administrator')->firstOrFail();

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

        foreach ($users as $user) {
            $u = User::create($user);
            $u->roles()->sync($roles);
        }

    }
}
