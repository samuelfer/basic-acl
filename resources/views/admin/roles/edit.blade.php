@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Perfil</h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>


            <form action="{{route('roles.update',[$role->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">

                <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$role->name}}" name='name' 
                            id="name" placeholder="Digite um nome">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="description" class="form-control @error('name') is-invalid @enderror" value="{{$role->description}}" 
                            name="description" id="description" placeholder="Digite a descrição">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('roles.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop