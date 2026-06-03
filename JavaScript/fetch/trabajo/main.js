fetch(`https://pokeapi.co/api/v2/pokemon/1`)
  //.json() transforma la respuesta (que esta en formato json) a un objeto de js
  .then((response) => response.json())
  .then((data) => console.log(data))
  .catch((error) => console.log(error(`ERROR `, error)));

async function obtenerPrimerPokemon() {
  try {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/1)`);
    const data = await response.json();
    console.log(data);
  } catch (error) {
    console.error(`ERROR`, error);
  }
}
obtenerPrimerPokemon();
const id = 10;
async function obtenerPokemon(id) {
  try {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await response.json();
    console.log(data);
  } catch (error) {
    console.error(`ERROR`, error);
  }
}
obtenerPokemon(id);
function crearCard(pokemon) {
  // Crear card
  const card = document.createElement("div");
  card.classList.add("pokemon-card");

  // Crear elementos
  const img = document.createElement("img");
  const nombre = document.createElement("h3");
  const tipo = document.createElement("span");
  const ul = document.createElement("ul");
  img.src = data.sprites.other[`official-artwork`].front_default;
  nombre.textContent = data.name;
  tipo.textContent = data.types[0].type.name;
  tipo.classList.add("tipo-electrico");
}
