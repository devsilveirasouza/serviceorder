<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return view('admin.clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = Client::all();
        return view('admin.clients.create', ['client' => $client]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        try {
            Client::create($request->all());

            return redirect()->route('clients.index')
                ->with('success', 'Registro criado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clients.index')
                ->with('error', 'Erro ao criar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $client->update($request->all());
            return redirect()->route('clients.index')
                ->with('success', 'Registro atualizado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clients.index')
                ->with('error', 'Não foi possível atualizar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Registro excluído com Sucesso!');
    }
}
