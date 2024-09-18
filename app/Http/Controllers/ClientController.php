<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Client $client)
    {
        $validator = Validator::make($client->all(), [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|string|email|min:10|max:100|unique:clients',
            'phone' => 'required|string|min:8/max:20',
            'address' => 'required|string|max:150',
        ]);

        $client = Client::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => request('address'),
        ]);

        return redirect()->route('clients.index');
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
    public function update(Client $client)
    {
        $client->fill(request()->all());
        $client->save();
        return redirect()->route('clients.index')->with('success', 'Registro atualizado com Sucesso!');
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
