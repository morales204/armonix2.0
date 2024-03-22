<script>
    // Function to trigger SweetAlert confirmation
    function deleteVolumenConfirmation(id) {
        Swal.fire({
            title: 'Eliminar Volumen',
            text: '¿Estás seguro que deseas eliminar este volumen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>


<!-- Your original form with a new id -->
<form id="delete-form-{{ $vol->id_volumen }}" action="{{ route('volumen.destroy', $vol->id_volumen) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
