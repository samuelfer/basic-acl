@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Usuário</h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>


            <form action="{{route('users.update',[$user->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">

                <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{$user->name}}" name='name' id="name" 
                            placeholder="Digite um nome">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"  value="{{$user->email}}" name="email" id="email" 
                            placeholder="Digite um email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="password" id="senha" placeholder="Digite a senha">
                    </div>
                   
                    
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('users.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop