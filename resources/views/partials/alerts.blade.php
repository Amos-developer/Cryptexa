<script>
    window.onload = function() {

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Plan Activated',
            text: @json(session('success')),
            timer: 2000,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb'
        }).then(() => {
            window.location.href = "{{ route('home') }}";
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Action Failed',
            text: @json(session('error')),
            confirmButtonText: 'OK',
            background: '#020617',
            color: '#e5e7eb'
        });
        @endif

    };
</script>