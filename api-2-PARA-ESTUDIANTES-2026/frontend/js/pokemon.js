let pokemones = [];
const maxPoke = 10;

// Estado del equipo seleccionado (máximo 5)
let equipoSeleccionado = [];
const MAX_EQUIPO = 5;

// Obtener la CI del usuario logueado desde localStorage
const usuarioCI = localStorage.getItem('usuario_ci');

document.addEventListener('DOMContentLoaded', () => {
    // Cargar Pokémon aleatorios
    getPokemonRandom();

    // Escuchar el evento click en el botón "Guardar Equipo"
    const btnGuardar = document.getElementById('btn-guardar-equipo');
    if (btnGuardar) {
        btnGuardar.addEventListener('click', guardarEquipoAPI);
    }
});


async function getPokemonRandom() {
    for (let i = 0; i < maxPoke; i++) {
        const num = Math.floor(Math.random() * 151) + 1;
        
        const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${num}`);
        const pokemonApi = await res.json();

        const type = pokemonApi.types[0].type.name;
        const pokeImgUrl = pokemonApi.sprites.other['official-artwork'].front_default;
        
        // Se guarda pokeId para poder identificarlo al enviar a la API
        const pokemon = {
            pokeId: pokemonApi.id,
            pokeName: pokemonApi.name,
            pokeType: type,
            pokeImg: pokeImgUrl
        };
        
        pokemones.push(pokemon);
    }

    renderizarPokemones();
}


async function renderizarPokemones() {
    const galeria = document.querySelector('#galeria');
    galeria.innerHTML = ''; // Limpiar galería antes de renderizar

    pokemones.forEach((pokemon) => {
        const card = document.createElement('div');
        card.classList.add('pokemon-card');

        // Atributos de datos para referencia
        card.dataset.id = pokemon.pokeId;

        const nombre = document.createElement('h3');
        nombre.classList.add('nombre');
        nombre.textContent = pokemon.pokeName.charAt(0).toUpperCase() + pokemon.pokeName.slice(1);

        const tipo = document.createElement('div');
        tipo.classList.add('icono');
        const tipoImg = document.createElement('img');
        tipoImg.src = `/frontend/assets/icons/${pokemon.pokeType}.svg`;
        tipo.appendChild(tipoImg);

        const sprite = document.createElement('img');
        sprite.classList.add('img');
        sprite.src = pokemon.pokeImg;

        // Ensamblar la card
        card.appendChild(nombre);
        card.appendChild(sprite);
        card.appendChild(tipo);

        card.addEventListener('click', () => {
            toggleSeleccionPokemon(card, pokemon);
        });

        galeria.appendChild(card);
    });
}


function toggleSeleccionPokemon(cardElement, pokemon) {
    // Buscar si ya está seleccionado mediante su ID
    const index = equipoSeleccionado.findIndex(p => p.id === pokemon.pokeId);

    if (index !== -1) {
        // Si ya está: Quitar del equipo y remover estilo CSS
        equipoSeleccionado.splice(index, 1);
        cardElement.classList.remove('selected');
    } else {
        // Si no está: Validar el tope de 5
        if (equipoSeleccionado.length >= MAX_EQUIPO) {
            alert(`Solo puedes seleccionar un máximo de ${MAX_EQUIPO} Pokémon.`);
            return;
        }

        // Agregar al array con las llaves que espera PHP
        equipoSeleccionado.push({
            id: pokemon.pokeId,
            nombre: pokemon.pokeName,
            sprite_url: pokemon.pokeImg
        });
        cardElement.classList.add('selected');
    }

    actualizarContadorUI();
}

function actualizarContadorUI() {
    const contadorText = document.getElementById('contador-pokemon');
    const btnGuardar = document.getElementById('btn-guardar-equipo');

    if (contadorText) {
        contadorText.textContent = `${equipoSeleccionado.length} / ${MAX_EQUIPO}`;
    }

    if (btnGuardar) {
        // El botón solo se habilita al tener exactamente 5
        btnGuardar.disabled = equipoSeleccionado.length !== MAX_EQUIPO;
    }
}

// Envía el array de 5 Pokémon al endpoint POST /api/usuarios/{ci}/equipo
async function guardarEquipoAPI() {
    if (equipoSeleccionado.length !== MAX_EQUIPO) {
        alert(`Debes seleccionar exactamente ${MAX_EQUIPO} Pokémon.`);
        return;
    }

    try {
        const respuesta = await fetch(`/api/usuarios/${usuarioCI}/equipo`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                pokemon: equipoSeleccionado
            })
        });

        const resultado = await respuesta.json();

        if (respuesta.ok) {
            alert('¡Equipo guardado con éxito!');
        } else {
            alert(`Error: ${resultado.error || 'No se pudo guardar el equipo'}`);
        }

    } catch (error) {
        console.error('Error al conectar con la API:', error);
        alert('Ocurrió un error al intentar enviar el equipo al servidor.');
    }
}

