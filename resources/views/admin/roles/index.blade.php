@extends('adminlte::page')

@section('title', 'Lista de Perfis')

@section('content_header')
<h1 class="m-0 text-dark">Lista de Perfis</h1>
@stop

@section('content')


<div class="row">
    <div class="col-12">
        @include('shared.success-message')
        <div class="card">
            <div class="card-header">
                @can('roles.create')
                    <a href="{{route('roles.create')}}" class="btn btn-sm btn-success float-right">NOVO PERFIL</a>
                @endcan     
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>DESCRIÇÃO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($roles as $role)
                    <tr>
                            <td>{{ $role->id}}</td>
                            <td>{{ $role->name}}</td>
                            <td>{{ $role->description}}</td>
                            <td>
                            @can('roles.update')<a href="{{route('roles.edit',[$role->id])}}" class="btn btn-sm btn-success">Editar</a>@endcan
                            @can('roles.delete')<a href="{{route('roles.delete',[$role->id])}}" class="btn btn-sm btn-danger">Excluir</a>@endcan
                            
                            </td>
                     </tr>

                    @empty
                        <tr>
                            <td colspan="5"> Ainda não há perfis cadastrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


                {{$roles->links()}}
            </div>

        </div>

    </div>
</div>


@stop