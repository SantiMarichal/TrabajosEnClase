/*
// Datos del Pokémon
const pikachu = {
    nombre: 'Pikachu',
    tipo: 'Eléctrico',
    imagen: 'pikachu.png',
    habilidades: ['Impactrueno', 'Rayo']
};

// Crear card con DOM
const card = document.createElement('div');
card.classList.add('pokemon-card');

const img = document.createElement('img');
img.src = pikachu.imagen;

const nombre = document.createElement('h3');
nombre.textContent = pikachu.nombre;

const tipo = document.createElement('span');
tipo.textContent = pikachu.tipo;
tipo.classList.add('tipo-electrico');

const ul = document.createElement('ul');
pikachu.habilidades.forEach((hab) => {
    console.log(hab);
    const li = document.createElement('li');
    li.textContent = hab;
    ul.appendChild(li);
});

card.appendChild(img);
card.appendChild(nombre);
card.appendChild(tipo);
card.appendChild(ul);
*/ 

const pokedex = [
    {
        nombre: "Charizard",
        tipo: "Fuego",
        imagen: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png',
        habilidades: ["Lanzallamas", "Vuelo"]
    },
    {
        nombre: 'Pikachu',
        tipo: 'Eléctrico',
        imagen: 'pikachu.png',
        habilidades: ['Impactrueno', 'Rayo']
    },
    {
        nombre: "Mew",
        tipo: "Psiquico",
        imagen: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png',
        habilidades: ["Psíquico", "Transformación"]
    }
];

function crearCard(pokemon) {
    // Crear card
    const card = document.createElement('div');
    card.classList.add('pokemon-card');

    // Crear elementos
    const img = document.createElement('img');
    const nombre = document.createElement('h3');
    const tipo = document.createElement('span');
    const ul = document.createElement('ul');
    // Configurar contenido. Ojo: hacer referencia al parámetro
    img.src = pokemon.imagen;
    nombre.textContent = pokemon.nombre;
    tipo.textContent = pokemon.tipo;
    tipo.classList.add('tipo-electrico');
    pokemon.habilidades.forEach((hab) => {
        console.log(hab);
        const li = document.createElement('li');
        li.textContent = hab;
        ul.appendChild(li);
    });

    // Ensamblar la card

    card.appendChild(img);
    card.appendChild(nombre);
    card.appendChild(tipo);
    card.appendChild(ul);
    document.querySelector('#contenedor-pokemon').appendChild(card);
}

pokedex.forEach((poke) => {
    crearCard(poke);
});



