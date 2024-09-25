<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoanDetailsController extends Controller
{
    public function index()
    {
        // Get all data for view loan details page
        $loans = LoanDetail::get();
        return view('loan-details', compact('loans'));
    }

    public function emiDetails()
    {
        $emiDetails = null;
        $columns = null;
        if (Schema::hasTable('emi_details')) {
            // Get dynamic data
            $emiDetails = DB::table('emi_details')->get();
            // Get dynamic columns
            $columns = Schema::getColumnListing('emi_details');
        }
        return view('emi-details', compact('emiDetails', 'columns'));
    }

    public function processData(Request $request)
    {
        // Drop the emi_details table if it exists
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $loanDetails = DB::table('loan_details')->get();

        // Calculate min and max dates
        $minDate = $loanDetails->min('first_payment_date');
        $maxDate = $loanDetails->max('last_payment_date');
        $startDate = Carbon::createFromFormat('Y-m-d', $minDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $maxDate);

        // loop for generate month columns
        $months = [];
        while ($startDate->lte($endDate)) {
            $months[] = $startDate->format('Y_M');
            $startDate->addMonth();
        }
        $columns = implode(', ', array_map(fn($month) => "`$month` DECIMAL(10,2) DEFAULT 0", $months));
        $columnsSql = "`clientid` INT, " . $columns;
        DB::statement("CREATE TABLE emi_details ($columnsSql)");

        // loop for each loan detail and calculate EMI
        foreach ($loanDetails as $loan) {
            $clientId = $loan->clientid;
            $totalLoanAmount = $loan->loan_amount;
            $numOfPayments = $loan->num_of_payment;
            $emi = round($totalLoanAmount / $numOfPayments, 2);
            $emiRow = ['clientid' => $clientId];
            $currentPaymentDate = Carbon::createFromFormat('Y-m-d', $loan->first_payment_date);
            $lastPaymentDate = Carbon::createFromFormat('Y-m-d', $loan->last_payment_date);
            $totalEmi = 0;
            for ($i = 0; $i < $numOfPayments; $i++) {

                $currentMonth = $currentPaymentDate->format('Y_M');
                // verify the condition for less then last payment date
                if ($currentPaymentDate->lte($lastPaymentDate)) {
                    // Set the EMI for the current month
                    $emiRow[$currentMonth] = $emi;
                    $totalEmi += $emi;  //total EMI
                } else {
                    // If we've passed the last payment date, just leave it as 0
                    $emiRow[$currentMonth] = 0;
                }
                // Move to the next month
                $currentPaymentDate->addMonthNoOverflow();
            }
            // Adjust the last month's value to ensure total equals loan amount
            $lastMonthKey = array_key_last($emiRow);
            $finalAdjustment = $totalLoanAmount - $totalEmi;

            // Verify the negative values
            if ($finalAdjustment > 0) {
                // Add remainder to last month
                $emiRow[$lastMonthKey] += $finalAdjustment;
            } elseif ($finalAdjustment < 0) {
                // If total EMI is more, reduce from the last month's payment
                $emiRow[$lastMonthKey] -= abs($finalAdjustment);
            }
            DB::table('emi_details')->insert($emiRow);
        }
        return redirect()->route('emi.details')->with('success', 'Emi Calculated Successfully!');;
    }
}
