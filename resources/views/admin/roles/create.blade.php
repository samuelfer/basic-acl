@extends('adminlte::page')

@section('title', 'Novo Perfil')

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet"
    href="https://adminlte.io/themes/v3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@section('content_header')
<h1 class="m-0 text-dark">Novo Perfil</h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>


            <form action="{{route('roles.store')}}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name'
                            id="name" placeholder="Digite um nome" value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                            name="descricao" id="descricao" placeholder="Digite a descrição"
                            value="{{ old('descricao') }}">
                        @error('descricao')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Associar permissões ao perfil</h3>
                        </div>
                        <select multiple="multiple" size="10" name="duallistbox_permissions[]"
                            title="duallistbox_permissions[]">

                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                            <!-- <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option4">Option 4</option>
                            <option value="option5">Option 5</option>
                            <option value="option7">Option 7</option>
                            <option value="option8">Option 8</option>
                            <option value="option9">Option 9</option>
                            <option value="option0">Option 10</option> -->
                        </select>


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


@section('js')
    <script>
        var demo1 = $('select[name="duallistbox_permissions[]"]').bootstrapDualListbox({
            moveSelectedLabel: 'Selecionar',
            moveAllLabel: 'Selecionar todos',
            infoText: 'Exibindo {0}',
            infoTextEmpty: 'Lista vazia'
        });
    </script>
@stop