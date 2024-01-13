@extends('adminlte::page')

@section('title', 'Logs')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listagem de Logs</h3>
    </div>

    <div class="card-body">
        <div id="list" class="dataTables_wrapper dt-bootstrap4">
            
            <div class="row">
                <div class="col-sm-12">
                    <table id="list-logs" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="list-logs">
                        <thead>
                            <th>TIPO</th>
                            <th>DADOS</th>
                            <th>EVENTO</th>
                            <th>FEITO POR</th>
                        </thead>
                        <tbody>

                        @forelse($allActivities as $activity)
                        <tr>
                            <td>{{ $activity->description}}</td>
                            <td>{{ $activity->properties }}</td>
                            <td>{{ $activity->event}}</td>
                            <td>{{ $activity->causer_id}}</td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5"> Ainda não há logs registrados.</td>
                        </tr>
                        @endforelse
                    
                        </tbody>
                    </table>
            
                </div>
            </div>
        
        </div>
    </div>

</div>

@stop


@section('js')

    <script>

        $(function () {
          
            $("#list-logs").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "search": "Pesquisar",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior",
                    "first": "Primeiro",
                    "last": "Último"
                },
                "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
            });
        });
        
    </script>

@stop