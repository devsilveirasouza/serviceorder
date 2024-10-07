<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\OrderService as OrderServiceItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders         = Order::with('client', 'vehicle', 'user')->get();
        return view('admin.orders.index', ['orders' => $orders]);
    }
    // Busca os veículos do cliente
    public function getVehicles($client_id)
    {
        // Obtenha os veículos do cliente selecionado
        $vehicles = Vehicle::where('client_id', $client_id)->get();
        // Retorne os veículos como uma resposta JSON
        return response()->json($vehicles);
    }

    /**
     * Exibe o formulário de criação de uma nova ordem de serviço.
     * Código Revisado
     */
    public function create(Request $request)
    {
        $clients        = Client::all();
        $vehicles       = Vehicle::with('client')->get();
        // Alterar para buscar automaticamente o usuário autenticado
        $users          = User::all();

        // Se um cliente foi selecionado, filtra os veículos do cliente
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
     * Armazena uma nova ordem de serviço no banco de dados
     * Código Revisado
     */
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'vehicle_id'  => 'required|exists:vehicles,id',
            'status'      => 'required',
        ]);

        // Criar a Ordem de Serviço
        $order = new Order();
        $order->client_id   = $request->client_id;
        $order->vehicle_id  = $request->vehicle_id;
        $order->user_id     = $request->user_id;
        $order->status      = $request->status;
        $order->save();

        // Redirecionar para a view de adicionar itens à ordem de serviço
        return redirect()->route('orderItems.create', [
            'order_id'   => $order->id,        // Passa o ID da ordem recém-criada
            'client_id'  => $request->client_id,
            'vehicle_id' => $request->vehicle_id,
        ])->with('success', 'Ordem de serviço criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->with('client', 'vehicle');
        return view('admin.orders.show', ['order' => $order]);
    }
}
