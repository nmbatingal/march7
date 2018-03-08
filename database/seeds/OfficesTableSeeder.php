<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            [
                'office_name' => 'Office of the Regional Director',
                'acronym' 	  => 'ORD',
            ],
            [
                'office_name' => 'Finance and Administrative Services',
                'acronym'  	  => 'FAS',
            ],
            [
                'office_name' => 'Field Operations Division',
                'acronym'  	  => 'FOD',
            ],
            [
                'office_name' => 'PSTC-Agusan del Norte',
                'acronym'  	  => 'PSTC-ADN',
            ],
            [
                'office_name' => 'PSTC-Agusan del Sur',
                'acronym'  	  => 'PSTC-ADS',
            ],
            [
                'office_name' => 'PSTC-Province of Dinagat Islands',
                'acronym'  	  => 'PSTC-PDI',
            ],
            [
                'office_name' => 'PSTC-Surigao del Norte',
                'acronym'  	  => 'PSTC-SDN',
            ],
            [
                'office_name' => 'PSTC-Surigao del Sur',
                'acronym' 	  => 'PSTC-SDS',
            ],
            [
                'office_name' => 'Technical Service Provider',
                'acronym'	  => 'TSS',
            ],
            [
                'office_name' => 'Regional Science and Technology Laboratory',
                'acronym' 	  => 'RSTL',
            ],
        ];

        DB::table('offices')->insert($offices);
    }
}
