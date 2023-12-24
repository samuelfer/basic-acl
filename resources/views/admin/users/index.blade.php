@extends('adminlte::page')

@section('title', 'Lista de Usuários')

@section('content_header')
<h1 class="m-0 text-dark">Lista de Usuários</h1>
@stop

@section('content')


<div class="row">
    <div class="col-12">
        @include('shared.success-message')
        <div class="card">
            <div class="card-header">
                @can('users.create')
                    <a href="{{route('users.create')}}" class="btn btn-sm btn-success float-right">NOVO USUÁRIO</a>
                @endcan     
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>EMAIL</th>
                            <th>CRIADO</th>
                            <th>ATUALIZADO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                    <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                            @can('users.update')<a href="{{route('users.edit',[$user->id])}}" class="btn btn-sm btn-success">Editar</a>@endcan
                            @can('users.delete')<a href="{{route('users.delete',[$user->id])}}" class="btn btn-sm btn-danger">Excluir</a>>@endcan
                            
                            </td>
                     </tr>

                    @empty
                        <tr>
                            <td colspan="5"> Ainda não há Usuários cadastrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


                {{$users->links()}}
            </div>

        </div>

    </div>
</div>


@stop