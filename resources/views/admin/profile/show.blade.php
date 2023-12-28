@extends('adminlte::page')

@section('title', 'Meus dados')

@section('adminlte_css')
    <style>
        /* Esconde o input */
        input[type='file'] {
            display: none
        }

        /* Aparência que terá o seletor de arquivo */
        .upload-image > label {
            background-color: #3498db;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            margin: 10px;
            padding: 6px 20px
        }
    </style>    
@stop

@section('content_header')
<h3></h3>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                @include('shared.success-message')
                @include('shared.error-message')
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <div class="row mb-4">
                                <form action="{{ route("users.save-image") }}" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $user->id }}" name="id">
                                    @if (isset($user->image) && !empty($user->image))
                                        <img id="preview" src="{{ asset('storage/'.$user->image) }}"
                                        class="profile-user-img img-fluid img-circle" alt="Foto do usuário">
                                    @endif

                                        <img id="preview" src="#" alt="Foto do usuário" class="profile-user-img img-fluid img-circle mt-3" style="display:none;"/>
                                    <div class="mt-2 upload-image">
                                        <label for='selectImage'>Selecionar imagem</label>
                                        <input type="file" class="form-control" name="image" @error('image') is-invalid
                                            @enderror id="selectImage">
                                    </div>
                    
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                    <p class="text-muted text-center">{{ $user->email }}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Cadastrado em:</b> <a class="float-right">{{ $user->created_at->format('d-m-Y')}}</a>
                                        </li>
                                    </ul>


                                    <button type="submit" class="btn btn-success btn-block mt-2">Salvar</button>
                                </form>
                            </div>

                        </div>
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
                                                        <button type="submit" class="btn btn-success">Salvar</button>
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

@section('js')

<script>
selectImage.onchange = evt => {
    preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}
</script>

@stop