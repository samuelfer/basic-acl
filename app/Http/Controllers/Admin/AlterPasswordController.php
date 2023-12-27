<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AlterPasswordController extends Controller
{
    public function index() 
    {
        return view('admin.password.alter');
    }

    public function store(UpdatePassword $request) 
    {
        $user = User::where('email', $request->email)->first();
       
        if (!$user) {
            return redirect()->route('home')->with('error', 'Usuário não encontrado!');
        }

        if (Auth::user()->email != $request->email && !$user->isAdmin(Auth::user())) {
            return redirect()->route('home')->with('error', 'Usuário não tem permissão para alterar a senha!');
        }

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);
    
        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('password.index')->with('error', 'Por favor, escolha uma senha diferente da atual!');
        }

        try {
            $user->update($data);
            return redirect()->route('home')->with('success', 'Senha alterada com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Ocorreu um erro ao tentar alterar a senha!');
        }
    }
}
