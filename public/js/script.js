function openMenu() {
    document.getElementById("sidebar").style.width = "250px";
    console.log("Función ejecutada");
}

function closeMenu() {
    document.getElementById("sidebar").style.width = "0";
    console.log("Función ejecutada");
}


// funcion btn ver mas detalles
$("#btnlaboratorista").click(function(){
    const additionalInfo = $("#additionalDetails").html();
  
    Swal.fire({
      title: "Detalles",
      html: additionalInfo,
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Aceptar",
      denyButtonText: `Rechazar`,
      cancelButtonText:"Cancelar",
      width: 1000,
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire('Prestamo aceptado!', '', 'success');
      } else if (result.isDenied) {
        Swal.fire("Prestamo rechazado", "", "info");
      }
    });
  });

  // funcion btn ver mas detalles
$("#btnalumno").click(function(){
  const additionalInfo = $("#additionalDetails").html();

  Swal.fire({
    title: "Detalles",
    html: additionalInfo,
    showConfirmButton:false,
    showDenyButton: true,
    showCancelButton: true,
    denyButtonText: `Eliminar`,
    cancelButtonText:"Cancelar",
    width: 1000,
  }).then((result) => {
   if (result.isDenied) {
      Swal.fire("Has eliminado tu prestamo", "", "success");
    }
  });
});