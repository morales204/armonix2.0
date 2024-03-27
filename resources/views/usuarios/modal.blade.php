<script>
    // Function to trigger SweetAlert confirmation
    function deleteUsuarioConfirmation(id) {
        Swal.fire({
            title: 'Eliminar usuario',
            text: '¿Deseas eliminar a este usuario?',
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
<form id="delete-form-{{ $usuario->id_usuario }}" action="{{ route('usuario.destroy', $usuario->id_usuario) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
