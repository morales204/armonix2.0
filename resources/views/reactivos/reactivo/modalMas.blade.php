<script>
    function verMas(id, tipo, nivelPeligrosidad, condicionesAlmacenamiento,reac) {
        Swal.fire({
            title: "Detalles del Reactivo",
            html: `
                <p>Familia: ${tipo}</p>
                <p>Nivel de Peligrosidad: ${nivelPeligrosidad}</p>
                <p>Condiciones de Almacenamiento: ${condicionesAlmacenamiento}</p>
                <img src="{{ asset('imagenes/reactivos/${reac}') }}" alt="Imagen Personalizada" style="width: 100%; height: auto;">
            `,
/*             imageUrl: "{{ asset('imagenes/reactivos/') }}"+ '/' + reac, */
            imageWidth: 600,
            imageHeight: 800,
            imageAlt: "Imagen Personalizada",
            timer: false,
            width: 800, // Ancho del SweetAlert
            height: 'auto'
        });
    }
</script>