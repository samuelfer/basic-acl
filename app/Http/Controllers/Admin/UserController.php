<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateImageProfile;
use App\Http\Requests\StoreUpdateUser;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



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
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUpdateUser $request)
    {
        try {
            $data = $request->all();

            $data['password'] = Hash::make($data['password']);
            
            $user = User::create($data);
            $user->roles()->sync($request->roles);
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
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('home')->with('error', 'Registro não encontrado!');
        }

        if (Auth::user()->id != $id) {
            return redirect()->route('home')->with('error', 'Usuário logado não pode editar os dados!');
        }
    
        return view('admin.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('users.view')->with('error', 'O usuário logado não pode editar usuários!');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.view')->with('error', 'Registro não encontrado!');
        }

        $idsRolesUser = [];
        
        foreach ($user->roles as $role) {
            array_push($idsRolesUser, $role->id);
        }

        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles', 'idsRolesUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUser $request, string $id)
    {
        try {
            if (!Auth::user()->is_admin) {
                return redirect()->route('users.view')->with('error', 'O usuário logado não pode editar usuários!');
            }
            
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('users.view')->with('error', 'Registro não encontrado!');
            }

            $dados = $request->all();
            
            if(!$dados['password']){
                $dados['password'] = $user->password;
            }

            $user->update($dados);
            $user->roles()->sync($request->roles);

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
        if (!Auth::user()->is_admin) {
            return redirect()->route('users.view')->with('error', 'O usuário logado não pode excluir usuários!');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.view')->with('errorDel', 'Registro não encontrado!');
        }

        if ($user->roles()->count() > 0  && $user->roles()->get()->contains('name', 'master')) {
            return redirect()->route('users.view')->with('errorDel', 'Registro não pode ser deletado!'); 
        }

        $user->delete();
        return redirect()->route('users.view')->with('successDel', 'Registro deletado com sucesso!');
    }

    public function saveImage(StoreUpdateImageProfile $request)
    {
        $user = User::find($request->id);
        $imagemOld = $user->image;

        if (!$user) {
            return redirect()->back()->with('error', 'Registro não encontrado!');
        }

        try {

            if($request->hasFile('image')) {
                // Get filename with the extension
                $filenameWithExt = Str::of($request->file('image')->getClientOriginalName());
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $user->id. $filename.'_'.time().'.'.$extension;

                $path = storage_path('uploads/users_image');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
        
                // Upload Image
                $request->file('image')->storeAs('public/uploads/users_image', $fileNameToStore);
            
                $data['image'] = $fileNameToStore;

                $imageManager = new ImageManager(new Driver());
                
                $image = $imageManager->read(storage_path('app/public/uploads/users_image/'). $data['image']);
                
                $image->resize(300, 200);
                $image->save(storage_path('uploads/users_image/'. $data['image']));
                $data['image'] = 'uploads/users_image/'. $data['image'];
                $user->update($data);

                if (!empty($imagemOld)) {
                    $this->fileDestroy($imagemOld);
                }
                $fileNameToStore =  $user->image;
            }
            
            return redirect()->back()->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar salvar o registro!');
        }
    }

    public function fileDestroy(string $filename)
    {
        $path = storage_path().'/app/public/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }  
    }
}
