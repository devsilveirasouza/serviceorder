<?php

namespace App\Http\Controllers;

use App\Models\AccountPayable;
use App\Models\AccountReceivable;
use App\Models\Client;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    // Show accounts payable
    public function showPayables()
    {
        $payables = AccountPayable::all();

        return view('financials.payables', ['payables' => $payables]);
    }

    // Create a new account payable
    public function createPayable(Request $request)
    {
        $payable = AccountPayable::create($request->all());
        return redirect()->route('financial.payables');
    }

    // Show accounts receivable
    public function showReceivables()
    {
        $clients = Client::all();
        $receivables = AccountReceivable::all();
        return view(
            'financials.receivables',
            [
                'clients' => $clients,
                'receivables' => $receivables
            ]
        );
    }

    // Create a new account receivable
    public function createReceivable(Request $request)
    {
        $receivable = AccountReceivable::create($request->all());
        return redirect()->route('financial.receivables');
    }

    // Show financial report for receivables and payables
    public function showReport(Request $request)
    {
        // Retrieve date range if provided
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query accounts payable
        $payables = AccountPayable::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('due_date', [$startDate, $endDate]);
        })->get();

        // Query accounts receivable
        $receivables = AccountReceivable::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('due_date', [$startDate, $endDate]);
        })->get();

        return view('financials.report', compact('payables', 'receivables'));
    }

    // Show financial dashboard
    public function grafics(Request $request)
    {
        // Option selected on date range
        $start_date                  = $request->input('start_date', now()->startOfMonth());
        $end_date                    = $request->input('end_date', now()->startOfMonth());

        // Consult accounts payable
        $accountsPayable            = AccountPayable::whereBetween('due_date', [$start_date, $end_date])->sum('amount');
        
        // Consult accounts receivable
        $accountsReceivable         = AccountReceivable::whereBetween('due_date', [$start_date, $end_date])->sum('amount');

        // Consult accounts payable and paid
        $paydAccounts               = AccountPayable::whereBetween('due_date', [$start_date, $end_date])->where('status', 'Paid')->sum('amount');

        // Consult accounts receivable and received
        $receivedAccounts           = AccountReceivable::whereBetween('due_date', [$start_date, $end_date])->where('status', 'received')->sum('amount');

        // Return dashboard with financials data to view
        return view(
            'financials.dashboard',
            [
                'accountsPayable'       => $accountsPayable,
                'accountsReceivable'    => $accountsReceivable,
                'paydAccounts'          => $paydAccounts,
                'receivedAccounts'      => $receivedAccounts,
                'start_date'            => $start_date,
                'end_date'              => $end_date
            ]
        );
    }
}
