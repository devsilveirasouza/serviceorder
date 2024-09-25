<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Part::all();

        return view('admin.parts.index', ['parts' => $parts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'quantity_in_stock' => 'required',
            ]);

            Part::create($request->all());

            return redirect()->route('parts.index')->with('success', 'Registro criado com Sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('parts.index')->with('error', 'Erro ao criar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Part $part)
    {
        return view('admin.parts.show', ['part' => $part]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Part $part)
    {
        return view('admin.parts.edit', ['part' => $part]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Part $part)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'quantity_in_stock' => 'required',
            ]);

            $part->update($request->all());

            return redirect()->route('parts.index')->with('success', 'Registro atualizado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('parts.index')->with('error', 'Não foi possível atualizar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part $part)
    {
        try {
            $part->delete();

            return redirect()->route('parts.index')->with('success', 'Registro excluído com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('parts.index')->with('error', 'Não foi possível excluir o registro: ' . $e->getMessage());
        }
    }
}
