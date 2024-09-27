<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Part;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($order_id, $client_id, $vehicle_id)
    {
        // Buscar a ordem, cliente e veículo pelo ID
        $order = Order::findOrFail($order_id);
        $client = Client::findOrFail($client_id);
        $vehicle = Vehicle::findOrFail($vehicle_id);

        // Buscar as peças e os itens de ordens de serviço associados ao veículo
        $parts = Part::all();
        $services = Service::all();

        // Retornar a view com os dados
        return view('admin.orders.orderItemsCreate', compact('order', 'client', 'vehicle', 'parts', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
               // Valida os dados recebidos
        $request->validate([
            'order_id'      => 'required|exists:orders,id',
            'services.*'    => 'exists:services,id',
            'service_qty.*' => 'required|integer|min:1',
            'parts.*'       => 'exists:parts,id',
            'part_qty.*'    => 'required|integer|min:1',
        ]);

        // Inserir os serviços da ordem
        if ($request->has('services')) {
            foreach ($request->services as $key => $service_id) {
                $orderItem  = new OrderItem();
                $orderItem->order_id        = $request->order_id;
                $orderItem->service_id      = $service_id;
                $orderItem->quantity        = $request->service_qty[$key];
                $orderItem->unit_price           = Service::find($service_id)->price; // Preço unmitário
                $orderItem->total_price           = Service::find($service_id)->price * $orderItem->quantity; // Calcular o preço total
                $orderItem->save();
            }
        }

        // Inserir as peças da ordem
        if ($request->has('parts')) {
            foreach ($request->parts as $key => $part_id) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $request->order_id;
                $orderItem->part_id = $part_id;
                $orderItem->quantity = $request->part_qty[$key];
                $orderItem->unit_price = Part::find($part_id)->price; // Busca o preço unitário
                $orderItem->total_price = Part::find($part_id)->price * $orderItem->quantity; // Calcular o preço total
                $orderItem->save();

                // Atualizar o estoque da peça
                $part = Part::find($part_id);
                $part->quantity_in_stock -= $orderItem->quantity;
                $part->save();
            }
        }

        return redirect()->route('orders.index')->with('success', 'Itens adicionados com sucesso!');

        // Retornar uma resposta de sucesso
        return response()->json(['message' => 'Itens adicionados com sucesso!']);
    }
}
