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

    public function getVehicles($client_id)
    {
        // Obtenha os veículos do cliente selecionado
        $vehicles = Vehicle::where('client_id', $client_id)->get();

        // Retorne os veículos como uma resposta JSON
        return response()->json($vehicles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $clients        = Client::all();
        $vehicles       = Vehicle::with('client')->get();
        $users          = User::all();

        $selectedClient = $request->input('client_id');

        $vehicles = $selectedClient ? Vehicle::where('client_id', $selectedClient)->get() : [];

        return view(
            'admin.orders.create',
            [
                'clients' => $clients,
                'vehicles' => $vehicles,
                'users' => $users,
                'selectedClient' => $selectedClient
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'status'        => 'required',
        ]);

        $order = new Order();
        $order->client_id     = $request->client_id;
        $order->vehicle_id    = $request->vehicle_id;
        $order->user_id       = $request->user_id;
        $order->status        = $request->status;
        $order->save();

        // Redirecionar para a view de adicionar itens à ordem de serviço
        return redirect()->route(
            'orderItems.create',
            [
                'order_id' => $order->id,
                'client_id' => $request->client_id,
                'vehicle_id' => $request->vehicle_id
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('client', 'vehicle', 'user', 'orderItems');
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
