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
                <h3 class="card-title">Novo Usuário</h3>
            </div>


            <form action="{{route('users.store')}}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name'
                            id="name" placeholder="Digite um nome" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="Digite um email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="password" id="senha"
                            placeholder="Digite a senha">
                    </div>
                    <div class="form-group">
                        <label for="roles">Selecione os perfis</label>
                        <select class="js-basic-multiple form-control" name="roles[]" multiple="multiple">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
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

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-basic-multiple').select2({
                placeholder: 'Selecione os itens',
                width: '100%'
            });
        });
    </script>
@stop