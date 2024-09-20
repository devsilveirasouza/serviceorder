<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('client')->get();
        return view('admin.vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.vehicles.create', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'brand'         => 'required',
            'model'         => 'required',
            'plate'         => 'required',
        ]);

        try {
            $vehicle = new Vehicle([
                'client_id'     => $request->client_id,
                'brand'         => $request->brand,
                'model'         => $request->model,
                'plate'         => $request->plate,
            ]);

            $vehicle->save();

            return redirect()->route('vehicles.index')
                ->with('success', 'Registro criado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('vehicles.index')
                ->with('error', 'Erro ao criar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicle = Vehicle::with('client')->find($vehicle->id);
        $clients = Client::all();
        return view('admin.vehicles.edit', ['vehicle' => $vehicle, 'clients' => $clients]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'brand'         => 'required',
            'model'         => 'required',
            'plate'         => 'required|unique:vehicles,plate,' . $vehicle->id,
        ]);

        try {

            $vehicle = Vehicle::findOrFail($vehicle->id);
            $vehicle->update($request->all());

            return redirect()->route('vehicles.index')
                ->with('success', 'Registro atualizado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('vehicles.index')
                ->with('error', 'Não foi possível atualizar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle = Vehicle::findOrFail($vehicle->id);
            $vehicle->delete();

            return redirect()->route('vehicles.index')
                ->with('success', 'Registro excluído com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('vehicles.index')
                ->with('error', 'Não foi possível excluir o registro: ' . $e->getMessage());
        }
    }
}
