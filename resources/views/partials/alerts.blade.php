<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>

@if (session('success'))
    <script>
        toastr.success(`{!! session('success') !!}`)
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error(`{!! session('error') !!}`)
    </script>
@endif

@if (session('warning'))
    <script>
        toastr.warning(`{!! session('warning') !!}`)
    </script>
@endif

@if (session('info'))
    <script>
        toastr.info(`{!! session('info') !!}`)
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error(`{!! $error !!}`);
        </script>
    @endforeach
@endif
