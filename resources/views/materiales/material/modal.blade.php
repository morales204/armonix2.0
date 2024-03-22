<script>
    // Function to trigger SweetAlert confirmation
    function deleteMaterialConfirmation(id) {
        Swal.fire({
            title: 'Eliminar material',
            text: '¿Deseas eliminar a este material?',
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
<form id="delete-form-{{ $mat->id_material }}" action="{{ route('material.destroy', $mat->id_material) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
