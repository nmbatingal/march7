<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\User;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function excel()
    {
        $payments = User::orderBy('firstname', 'ASC')
                    ->select(
                        'id',
                        DB::raw("concat(firstname, ' ', lastname) as fullname"),
                        'email',
                        'created_at')
                    ->get();

        /*$paymentsArray = [];
        $paymentsArray[] = ['id', 'customer','email','created_at'];

        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }*/

        /*\Excel::create('payments', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');*/

        return $payments;
    }
}