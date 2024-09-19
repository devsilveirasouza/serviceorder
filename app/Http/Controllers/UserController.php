<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:3|max:100',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8|max:20',
            'role'          => 'required',
        ]);

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
    public function update(User $user)
    {
        $user->fill(request()->all());
        $user->save();
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        $user = User::find($user);

        $user->delete();

        return redirect()->route('users.index');
    }
}
