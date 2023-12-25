@if(session()->has('success'))
    @section('js')
        <script>
            $(document).ready(function() {
                toastr.success("{{ session('success') }}");
            });
        </script>
    @stop
@endif