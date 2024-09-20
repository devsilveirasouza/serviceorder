<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('admin.users.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, User $user)
    {
        try {
            $user               = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user['password']   = bcrypt($request->password);
            $user->role         = $request->role;
            $user->save();

            return redirect()->route('users.index')
                ->with('success', 'Registro criado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Erro ao criar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update(request()->all());
            return redirect()->route('users.index')
                ->with('success', 'Registro atualizado com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Não foi possível atualizar o registro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'Registro excluído com Sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Não foi possível excluir o registro: ' . $e->getMessage());
        }
    }
}
