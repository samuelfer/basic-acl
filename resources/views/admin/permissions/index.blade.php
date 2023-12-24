@extends('adminlte::page')

@section('title', 'Lista de Permissões')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de Permissões</h1>
@stop

@section('content')


<div class="row">
    <div class="col-12">
        @include('shared.success-message')
        @include('shared.error-message')
        <div class="card">
            <div class="card-header">
                @can('permissions.create')
                    <a href="{{route('permissions.create')}}" class="btn btn-sm btn-success float-right">NOVA PERMISSÃO</a>
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
                    @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id}}</td>
                            <td>{{ $permission->name}}</td>
                            <td>{{ $permission->description}}</td>
                            <td>
                                @can('permissions.update')<a href="{{route('permissions.edit',[$permission->id])}}" class="btn btn-sm btn-success">Editar</a>@endcan
                                @can('permissions.delete')
                                    <form action="{{route('permissions.delete', $permission->id)}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5"> Ainda não há Permissões cadastradas.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


                {{$permissions->links()}}
            </div>

        </div>

    </div>
</div>


@stop