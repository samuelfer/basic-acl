@extends('adminlte::page')

@section('title', 'Meus dados')

@section('content_header')
<h3></h3>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">{{ $user->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Cadastrado em:</b> <a class="float-right">{{ $user->created_at->format('d-m-Y')}}</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block"><b>Alterar foto</b></a>
                    </div>

                </div>

            </div>

            <div class="col-md-9 card card-primary card-outline">
                <div class="">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Dados
                                    pessoais</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">
                                    Funções</a></li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="active tab-pane" id="settings">
                
                                <div class="post">
                                    <div class="user-block">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Meus dados</h3>
                                            </div>
                                            <form class="form-horizontal container mt-2">
                                                <div class="form-group">
                                                    <label for="name">Nome</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{$user->name}}" name='name' id="name"
                                                        placeholder="Digite um nome" required>
                                                    @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{$user->email}}" name="email" id="email"
                                                        placeholder="Digite um email" required>
                                                    @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-danger">Salvar</button>
                                                        <a href="{{route('home')}}" type="button"
                                                            class="btn btn-default">Cancelar</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                   
                            </div>

                            <div class="tab-pane" id="activity">

                                <div class="post">
                                    <div class="user-block">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Minhas Funções</h3>
                                            </div>

                                            <div class="card-body">
                                                @forelse($user->roles as $role)
                                                <strong><i class="far fa-file-alt mr-1"></i>
                                                    {{ $role->description ?? Str::ucfirst($role->name)}}
                                                    <p>
                                                        @foreach($role->permissions as $permission)
                                                        <span
                                                            class="badge bg-warning">{{ $permission->description ?? $permission->name}}</span>
                                                        @endforeach
                                                    </p>
                                                </strong>

                                                <hr>
                                                @empty
                                                <tr>
                                                    <td colspan="5"> Esse usuário não posui permissões.</td>
                                                </tr>
                                                @endforelse
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
@stop