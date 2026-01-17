<script>
    window.onload = function() {

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Plan Activated',
            text: @json(session('success')),
            toast: true,
            position: 'center',
            timer: 2500,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb',
            iconColor: '#38bdf8'
        }).then(() => {
            window.location.href = "{{ route('home') }}";
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Action Failed',
            text: @json(session('error')),
            toast: true,
            position: 'center',
            timer: 3000,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb',
            iconColor: '#ef4444'
        });
        @endif

    };

    // ✅ MUST BE GLOBAL
    function copyAddress() {
        const address = document.getElementById('walletAddress')?.innerText;

        if (!address || address.includes('Waiting')) return;

        const tempInput = document.createElement('textarea');
        tempInput.value = address;
        tempInput.setAttribute('readonly', '');
        tempInput.style.position = 'fixed';
        tempInput.style.opacity = '0';

        document.body.appendChild(tempInput);
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // iOS fix

        document.execCommand('copy');
        document.body.removeChild(tempInput);

        Swal.fire({
            icon: 'success',
            title: 'Copied',
            text: 'Deposit address copied',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb',
            iconColor: '#38bdf8'
        });
    }
</script>