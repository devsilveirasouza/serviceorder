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
}
