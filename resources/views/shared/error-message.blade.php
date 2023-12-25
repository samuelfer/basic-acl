@if(session()->has('error'))
    @section('js')
        <script>
            $(document).ready(function() {
                toastr.error("{{ session('error') }}");
            });
        </script>
    @stop
@endif