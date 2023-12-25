<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(StoreUpdateRole $request)
    {
        try {
            $data = $request->all();
        
            Role::create($data);
            return redirect()->route('roles.view')->with('success', 'Registro salvo com sucesso!');

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
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.view')->with('error', 'Registro não encontrado!');
        }
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRole $request, string $id)
    {
        try {
            $role = Role::find($id);
            $data = $request->all();

            $role->update($data);

            return redirect()->route('roles.view')->with('success', 'Registro salvo com sucesso!');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->back()->with('errorDel', 'Registro não encontrado!');
        }

        if ($role->permissions()->count() > 0) {
            return redirect()->back()->with('errorDel', 'Registro não pode ser deletado!'); 
        }

        $role->delete();
        return redirect()->route('roles.view')->with('successDel', 'Registro deletado com sucesso!');
    }
}
