@extends('adminlte::page')

@section('title', 'Novo Usuário')  

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Alterar senha</h3>
            </div>


            <form action="{{route('password.store')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="Confirme seu email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="password" id="senha"
                            placeholder="Digite a nova senha">
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