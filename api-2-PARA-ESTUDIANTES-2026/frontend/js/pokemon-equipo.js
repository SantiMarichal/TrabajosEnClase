
const usuarioCI = localStorage.getItem('usuario_ci');
let pokemones = [];

document.addEventListener('DOMContentLoaded', obtenerEquipoPokemon);

async function obtenerEquipoPokemon() {
    try {
        const respuesta = await fetch(`/api/usuarios/${usuarioCI}/equipo`);

        const resultado = await respuesta.json();

        console.log(resultado);

        if (respuesta.ok) {
            alert('¡Equipo obtenido con éxito!');
            pokemones = resultado.equipo;
            renderizarPokemones();
        } else {
            alert(`Error: ${resultado.error || 'No se pudo obtener el equipo'}`);
        }

    } catch (error) {
        console.error('Error al conectar con la API:', error);
        alert('Ocurrió un error al intentar enviar el equipo al servidor.');
    }
}

async function renderizarPokemones() {
    const galeria = document.querySelector('#galeria');
    galeria.innerHTML = ''; // Limpiar galería antes de renderizar

    pokemones.forEach((pokemon) => {
        const card = document.createElement('div');
        card.classList.add('pokemon-card');

        // Atributos de datos para referencia
        card.dataset.id = pokemon.pokemon_id;

        const nombre = document.createElement('h3');
        nombre.classList.add('nombre');
        nombre.textContent = pokemon.nombre.charAt(0).toUpperCase() + pokemon.nombre.slice(1);

        /* ver qué hacer con el tipo <<<<<<<<<<<<<<<<<<-----------------------------------
        const tipo = document.createElement('div');
        tipo.classList.add('icono');
        const tipoImg = document.createElement('img');
        tipoImg.src = `/frontend/assets/icons/${pokemon.pokeType}.svg`;
        tipo.appendChild(tipoImg);
        */

        const sprite = document.createElement('img');
        sprite.classList.add('img');
        sprite.src = pokemon.sprite_url;

        // Ensamblar la card
        card.appendChild(nombre);
        card.appendChild(sprite);
        /*card.appendChild(tipo);*/

        // --- Evento de selección con Click ---
        card.addEventListener('click', () => {
            toggleSeleccionPokemon(card, pokemon);
        });

        galeria.appendChild(card);
    });
}