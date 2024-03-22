<script>
    // Function to trigger SweetAlert confirmation
    function deleteReactivoConfirmation(id) {
        Swal.fire({
            title: 'Eliminar reactivo',
            text: '¿Deseas eliminar a este reactivo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>


<!-- Your original form with a new id -->
<form id="delete-form-{{ $reac->id_reactivo }}" action="{{ route('reactivo.destroy', $reac->id_reactivo) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
