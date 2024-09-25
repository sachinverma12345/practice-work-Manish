<?php

namespace Database\Seeders;

use App\Models\LoanDetail;
use Illuminate\Database\Seeder;

class LoanDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loanDetails = [
            [
                'clientid' => 1001,
                'num_of_payment' => 12,
                'first_payment_date' => '2018-06-29',
                'last_payment_date' => '2019-05-29',
                'loan_amount' => 1550,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'clientid' => 1002,
                'num_of_payment' => 7,
                'first_payment_date' => '2019-02-15',
                'last_payment_date' => '2019-08-15',
                'loan_amount' => 6851.94,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'clientid' => 1003,
                'num_of_payment' => 17,
                'first_payment_date' => '2017-11-09',
                'last_payment_date' => '2019-03-09',
                'loan_amount' => 1800.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the loan_details table
        LoanDetail::insert($loanDetails);
    }
}
