<?php

use Illuminate\Database\Seeder;

class MonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [
            [
                'month_name' => 'January',
                'acronym'    => 'Jan',
            ],
            [
                'month_name' => 'February',
                'acronym'    => 'Feb',
            ],
            [
                'month_name' => 'March',
                'acronym'    => 'Mar',
            ],
            [
                'month_name' => 'April',
                'acronym'    => 'Apr',
            ],
            [
                'month_name' => 'May',
                'acronym'    => 'May',
            ],
            [
                'month_name' => 'June',
                'acronym'    => 'Jun',
            ],
            [
                'month_name' => 'July',
                'acronym'    => 'Jul',
            ],
            [
                'month_name' => 'August',
                'acronym'    => 'Aug',
            ],
            [
                'month_name' => 'September',
                'acronym'    => 'Sep',
            ],
            [
                'month_name' => 'October',
                'acronym'    => 'Oct',
            ],
            [
                'month_name' => 'November',
                'acronym'    => 'Nov',
            ],
            [
                'month_name' => 'December',
                'acronym'    => 'Dec',
            ],
        ];
        
        DB::table('table_month')->insert($months);
    }
}
