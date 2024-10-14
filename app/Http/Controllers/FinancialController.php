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
        $receivable = AccountReceivable::crete($request->all());
        return redirect()->route('financial.receivables');
    }
}
