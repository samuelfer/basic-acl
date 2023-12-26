@extends('adminlte::page')

@section('title', 'Nova Permissão')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nova Permissão</h3>
            </div>

            <form action="{{route('permissions.store')}}" method="post" >
                @csrf 
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' id="name" 
                            placeholder="Digite um nome" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control @error('descricao') is-invalid @enderror" 
                            name="descricao" id="descricao" placeholder="Digite a descrição" value="{{ old('descricao') }}">
                            @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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