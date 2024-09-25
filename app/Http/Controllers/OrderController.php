<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders         = Order::with('client', 'vehicle', 'user')->get();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients        = Client::all();
        $vehicles       = Vehicle::all();
        $users          = User::all();   

        return view('admin.orders.create', ['clients' => $clients, 'vehicles' => $vehicles, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'status'        => 'required',
        ]);

        Order::create([
            'client_id'     => $request->client_id,
            'vehicle_id'    => $request->vehicle_id,
            'user_id'       => $request->user_id,
            'status'        => $request->status,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Registro criado com Sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $clients        = Client::all();
        $vehicles       = Vehicle::all();
        $users          = User::all();  
        return view('admin.orders.edit', ['order' => $order, 'clients' => $clients, 'vehicles' => $vehicles, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'status'        => 'required',
        ]); 

        $order->update([
            'client_id'     => $request->client_id,
            'vehicle_id'    => $request->vehicle_id,
            'user_id'       => $request->user_id,
            'status'        => $request->status,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Registro atualizado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Registro excluído com Sucesso!');
    }
}
