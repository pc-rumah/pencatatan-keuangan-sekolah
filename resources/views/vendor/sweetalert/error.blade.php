@if ($errors->any())
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: @json($errors->first()),
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif
