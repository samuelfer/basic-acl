<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $role = Role::create($data);
            $role->permissions()->sync($request->permissions);
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
        if (!Auth::user()->is_admin) {
            return redirect()->route('roles.view')->with('error', 'O usuário logado não pode editar perfis!');
        }
        
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.view')->with('error', 'Registro não encontrado!');
        }
        $permissions = Permission::all();
        $idsPermissionsRoles = [];
        
        foreach ($role->permissions as $permission) {
            array_push($idsPermissionsRoles, $permission->id);
        }
        return view('admin.roles.edit', compact('role', 'permissions', 'idsPermissionsRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRole $request, string $id)
    {
        try {
            if (!Auth::user()->is_admin) {
                return redirect()->route('roles.view')->with('error', 'O usuário logado não pode editar perfis!');
            }

            $role = Role::find($id);
            $data = $request->all();

            $role->update($data);
            $role->permissions()->sync($request->permissions);

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
        if (!Auth::user()->is_admin) {
            return redirect()->route('roles.view')->with('error', 'O usuário logado não pode excluir perfis!');
        }

        $role = Role::find($id);
        if (!$role) {
            return redirect()->back()->with('errorDel', 'Registro não encontrado!');
        }

        if ($role->permissions()->count() > 0 || $role->name == 'master') {
            return redirect()->back()->with('errorDel', 'Registro não pode ser deletado!'); 
        }

        $role->delete();
        return redirect()->route('roles.view')->with('successDel', 'Registro deletado com sucesso!');
    }
}
