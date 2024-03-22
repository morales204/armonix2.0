<script>
    // Function to trigger SweetAlert confirmation
    function deleteFamiliaConfirmation(id) {
        Swal.fire({
            title: 'Danger Modal',
            text: '¿Deseas eliminar la familia?',
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
<form id="delete-form-{{ $fam->id_familia }}" action="{{ route('familia.destroy', $fam->id_familia) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
