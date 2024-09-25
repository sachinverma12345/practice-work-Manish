<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $loanCount = LoanDetail::sum('loan_amount');
        $userCount = User::count();
        return view('dashboard', compact('loanCount', 'userCount'));
    }
}
