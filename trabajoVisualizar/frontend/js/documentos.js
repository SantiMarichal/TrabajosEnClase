const usuarioCI = localStorage.getItem('usuario_ci');

const formulario = document.getElementById("formulario");
const archivoInput = document.getElementById("archivo");
const mensaje = document.getElementById("mensaje");

const listaDocumentos = document.getElementById("listaDocumentos");
const visorPDF = document.getElementById("visorPDF");


// Funcionalidad de subir PDF. POST /api/documentos
formulario.addEventListener("submit", async function (event) {

    event.preventDefault();

    const archivo = archivoInput.files[0];

    if (!archivo) {
        mostrarMensaje("Seleccione un archivo PDF.", false);
        return;
    }

    if (archivo.type !== "application/pdf") {
        mostrarMensaje("El archivo debe ser un PDF.", false);
        return;
    }

    if (archivo.size > 10 * 1024 * 1024) {
        mostrarMensaje("El archivo no puede superar los 10 MB.", false);
        return;
    }

    // Construimos los datos que recibirá PHP.
    const datos = new FormData();

    datos.append("archivo", archivo);
    datos.append("usuarioCI", usuarioCI);

    try {

        mostrarMensaje("Subiendo archivo...", true);

        const respuesta = await fetch('/api/documentos', {
            method: "POST",
            body: datos
        });

        const resultado = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error(
                resultado.error || "No se pudo subir el archivo."
            );
        }

        mostrarMensaje(resultado.mensaje, true);

        formulario.reset();

        // Actualizamos el listado para mostrar el nuevo PDF.
        await cargarDocumentos();

    } catch (error) {

        console.error(error);

        mostrarMensaje(
            error.message || "Error de conexión con la API.",
            false
        );
    }
});

// Mensaje subida pdf. Correcto o incorrecto
function mostrarMensaje(texto, correcto) {
    mensaje.textContent = texto;
    mensaje.style.color = correcto ? "#15857A" : "#C0392B";
}

// Listar documentos. GET /api/documentos/${usuarioCI}
async function cargarDocumentos() {
    try {
        listaDocumentos.textContent = "Cargando documentos...";
        const respuesta = await fetch(`/api/documentos/${usuarioCI}`);
        const documentos = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error(documentos.error || "No se pudieron cargar los documentos.");
        }

        // Se limpia el contenedor de los documentos
        listaDocumentos.replaceChildren();

        if (documentos.length === 0) {
            const texto = document.createElement("p");
            texto.textContent = "No hay documentos disponibles.";
            listaDocumentos.appendChild(texto);

            return;
        }

        documentos.forEach(documento => {
            crearDocumentoHTML(documento);
        });

    } catch (error) {
        console.error(error);
        listaDocumentos.textContent = "No se pudieron cargar los documentos.";
    }
}


// Se crea el contenedor HTML para cada documento en cada iteración de documentos.forEach
function crearDocumentoHTML(documento) {

    const contenedor = document.createElement("div");
    contenedor.classList.add("documento");

    // Nombre del archivo
    const nombre = document.createElement("span");
    nombre.classList.add("nombre");
    nombre.textContent = documento.nombre_archivo;

    // Contenedor de buttons
    const acciones = document.createElement("div");
    acciones.classList.add("acciones");

    // Button visualizar
    const botonVer = document.createElement("button");
    botonVer.type = "button";
    botonVer.textContent = "Ver PDF";

    botonVer.addEventListener("click", () => {
        verPDF(documento.id);
    });

    // Button eliminar
    const botonEliminar = document.createElement("button");
    botonEliminar.type = "button";
    botonEliminar.textContent = "Eliminar";

    botonEliminar.addEventListener("click", () => {
        eliminarPDF(documento.id);
    });

    acciones.appendChild(botonVer);
    acciones.appendChild(botonEliminar);

    contenedor.appendChild(nombre);
    contenedor.appendChild(acciones);

    listaDocumentos.appendChild(contenedor);
}


// Funcionalidad visualizar PDF
function verPDF(id) {
    // La API devuelve el archivo PDF, no un JSON.
    visorPDF.src = `/api/documentos/${usuarioCI}/${id}`;

    visorPDF.hidden = false;

    visorPDF.scrollIntoView({
        behavior: "smooth",
        block: "start"
    });
}


// Funcionalidad eliminar PDF. DELETE /api/documentos/${usuarioCI}/${id}
async function eliminarPDF(id) {
    const confirmar = confirm("¿Está seguro de que desea eliminar este documento?");

    if (!confirmar) { return; }

    try {
        const respuesta = await fetch(
            `/api/documentos/${usuarioCI}/${id}`,
            {
                method: "DELETE"
            }
        );

        const resultado = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error(resultado.error || "No se pudo eliminar el documento.");
        }

        mostrarMensaje(resultado.mensaje, true);

        // Se cierra el visor para no mostrar el PDF eliminado
        visorPDF.removeAttribute("src");
        visorPDF.hidden = true;

        // Actualizamos el listado de PDFs, una vez borrado algún PDF
        await cargarDocumentos();

    } catch (error) {
        console.error(error);
        mostrarMensaje(error.message || "Error de conexión con la API.", false);
    }
}


cargarDocumentos();