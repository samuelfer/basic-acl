@extends('adminlte::page')

@section('title', 'Editar Permissão')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Permissão</h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>


            <form action="{{route('permissions.update',[$permission->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">

                <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" value="{{$permission->name}}" name='name' id="name" placeholder="Digite um nome">
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="description" class="form-control" value="{{$permission->description}}" name="description" id="description" placeholder="Digite a descrição">
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('permissions.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop