@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('adminlte_css')
    <style>
        .select2-selection__choice {
            background-color: #007bff!important;
        }
    </style>   

@endsection

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Usuário</h3>
            </div>


            <form action="{{route('users.update',[$user->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">

                <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{$user->name}}" name='name' id="name" 
                            placeholder="Digite um nome" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"  value="{{$user->email}}" name="email" id="email" 
                            placeholder="Digite um email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="senha" title="Apenas informe esse campo se deseja alterar a senha do usuário">Senha</label>
                        <input type="password" class="form-control" name="password" id="senha" placeholder="Digite a senha">
                    </div>
                   
                    <div class="form-group">
                        <label for="roles">Selecione os perfis</label>
                        <select class="js-basic-multiple form-control" name="roles[]" multiple="multiple">
                            @foreach($roles as $role)
                                <option  @if (in_array($role->id, $idsRolesUser)) selected @endif
                                    value="{{ $role->id }}">{{ $role->name }}</option>
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