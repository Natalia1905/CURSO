// Función para mostrar el modal con la información del curso
function mostrarInfoCurso(titulo, curso, descripcion) {
    document.getElementById('tituloCurso').innerText = titulo + ": " + curso;
    document.getElementById('descripcionCurso').innerText = descripcion;

    // Mostrar el modal
    document.getElementById('modalCurso').style.display = "flex";
}

// Función para cerrar el modal
function cerrarModal() {
    document.getElementById('modalCurso').style.display = "none";
}
