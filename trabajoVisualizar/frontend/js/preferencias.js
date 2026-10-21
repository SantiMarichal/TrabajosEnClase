const usuarioCI = localStorage.getItem('usuario_ci');

const formulario = document.getElementById("formPreferencias");

formulario.addEventListener("submit", async function (event) {
    event.preventDefault();

    const datos = new FormData(formulario);

    const generacionFavorita = datos.get("generacion_favorita");
    const estiloEntrenador = datos.get("estilo_entrenador");
    const tiposSeleccionados = datos.getAll("tipos_pokemon[]");
    const soloEvolucionados = datos.get("solo_evolucionados");

    console.log(generacionFavorita);
    console.log(estiloEntrenador);
    console.log(tiposSeleccionados);
    console.log(soloEvolucionados);

    try {
        const respuesta = await fetch(`/api/preferencias`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                ci: usuarioCI,
                generacion: generacionFavorita,
                estilo: estiloEntrenador,
                tipos: tiposSeleccionados
            })
        });

        const resultado = await respuesta.json();

        if (respuesta.ok) {
            alert('Preferencias guardadas con éxito!');
        } 

    } catch (error) {
        console.error('Error al conectar con la API:', error);
        alert('Ocurrió un error al intentar enviar el equipo al servidor.');
    }
});

