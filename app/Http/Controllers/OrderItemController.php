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
     * Exibe o formulário de adição de serviços e peças a uma ordem de serviço.
     */
    public function create($order_id, $client_id, $vehicle_id)
    {
        // Busca a ordem, cliente e veículo correspondentes
        $order    = Order::findOrFail($order_id);
        $client   = Client::findOrFail($client_id);
        $vehicle  = Vehicle::findOrFail($vehicle_id);

        // Busca os itens da ordem
        $parts = Part::all();
        $services = Service::all();

        // Retorna a view com os dados necessários
        return view('admin.orders.orderItemsCreate', [
            'order'     => $order,
            'client'    => $client,
            'vehicle'   => $vehicle,
            'parts'     => $parts,
            'services'  => $services,
        ]);
    }
    /**
     * Armazena os serviços e peças adicionadas à ordem de serviço.
     */
    public function addItemsOrder(Request $request)
    {
        // Valida os dados do formulário
        $validated = $request->validate([
            'order_id'      => 'required|exists:orders,id',
            'services.*'    => 'exists:services,id',
            'service_qty.*' => 'required|integer|min:1',
            'part_id.*'     => 'exists:parts,id',
            'part_qty.*'    => 'required|integer|min:1',
        ]);

        // Carrega a ordem de serviço
        $order = Order::findOrFail($request->order_id);

        // Inicializa o total price se não estiver definido
        if ($order->total_price === null) {
            $order->total_price = 0;
        }

        // Inicializa o totalServicePrice e totalPartPrice se não estiverem definidos
        $totalServicePrice = 0;
        $totalPartPrice = 0;

        // Processa os serviços
        if ($request->has('services')) {
            foreach ($request->services as $key => $service_id) {
                $service = Service::findOrFail($service_id);
                // Criar associação usando o método create
                $order->services()->create([
                    'service_id'    => $service_id,
                    'quantity'      => $request->service_qty[$key],
                    'unit_price'    => $service->price,
                    'total_price'   => $service->price * $request->service_qty[$key],
                ]);
                // Atualizar o preço total dos serviços
                $totalServicePrice += $service->price * $request->service_qty[$key];
            }
        }

        // Processa as peças
        if ($request->has('parts')) {
            foreach ($request->parts as $key => $part_id) {
                $part = Part::findOrFail($part_id);
                // Criar associação usando o método create
                $order->parts()->create([
                    'part_id'       => $part_id,
                    'quantity'      => $request->part_qty[$key],
                    'unit_price'    => $part->price,
                    'total_price'   => $part->price * $request->part_qty[$key],
                ]);
                // Atualizar o preço total das pecas
                $totalPartPrice += $part->price * $request->part_qty[$key];
            }
        }

        /**
         * Atualiza o preço total da ordem com base no que está sendo adicionado
         * Não é uma boa prática, mas é a maneira mais simples de atualizar o preço total
         */
        // $order->total_price = $totalServicePrice + $totalPartPrice;
        /**
         * Ou atualiza o preço total da ordem com base no que já está cadastrado na OS 
         * somados aos itens que estão sendo adicionados 
         * É uma boa prática porque a cada atualização do item, o preço total da ordem se atualiza
         * */ 
        $order->total_price = $order->services->sum('total_price') + $order->parts->sum('total_price');

        // Atualizar o status da ordem
        $order->status = "Em Andamento";
        // Salvar a ordem de serviço
        $order->save();

        // Redireciona para a index da ordem de serviço       
        return redirect()->route('orders.index');
    }
}
