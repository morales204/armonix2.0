<script>
    function verMas(id, tipo, nivelPeligrosidad, condicionesAlmacenamiento, reac) {
        // Verificar si existe una hoja de seguridad
        var hojaSeguridadUrl = '{{ asset('pdf/reactivos/') }}' + '/' + reac;
        var hasHojaSeguridad = false;

        // Realizar una petición HEAD para verificar la existencia del archivo
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', hojaSeguridadUrl, false);
        xhr.send();

        if (xhr.status === 200) {
            hasHojaSeguridad = true;
        }

        Swal.fire({
            title: "Detalles del Reactivo",
            html: `
                <p>Familia: ${tipo}</p>
                <p>Nivel de Peligrosidad: ${nivelPeligrosidad}</p>
                <p>Condiciones de Almacenamiento: ${condicionesAlmacenamiento}</p>
                ${hasHojaSeguridad ? `<iframe src="${hojaSeguridadUrl}" style="width: 100%; height: 500px;" frameborder="0"></iframe>` : '<p>No hay hoja de seguridad disponible</p>'}
            `,
            imageWidth: 600,
            imageHeight: 800,
            imageAlt: "Imagen Personalizada",
            timer: false,
            width: 800
        });
    }
</script>
