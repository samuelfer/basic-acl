<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);

            User::create($data);
            return redirect()->route('users.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar cadastrar!');
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            $dados = $request->all();

            if(!$dados['password']){
                $dados['password'] = $user->password;
            }

            $user->update($dados);

            return redirect()->route('users.view')->with('success', 'Registro salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.view')->with('error', 'Registro não encontrado!');
        }

        if ($user->roles()->count() > 0  && $user->roles()->get()->contains('name', 'master')) {
            return redirect()->route('users.view')->with('error', 'Registro não pode ser deletado!'); 
        }

        $user->delete();
        return redirect()->route('users.view')->with('success', 'Registro deletado com sucesso!');
    }
}
