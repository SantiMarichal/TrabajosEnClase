const nombrePokemon = "Pikachu";
const tipo = "Electrico";
let nivel = 25;
function describirPokemon(nombrePokemon, tipo, nivel) {
  return `${nombrePokemon} es de tipo ${tipo} y es nivel ${nivel}`;
}
console.log(describirPokemon(nombrePokemon, tipo, nivel));
const esPokemonFuerte = (nivel) => {
  if (nivel >= 30) {
    return true;
  } else {
    return false;
  }
};
console.log(esPokemonFuerte(nivel));

const Pokemon = {
  nombre: "Charizard",
  tipo: "Fuego",
  ataques: ["Lanzallamas", "Vuelo"],
  ataquePrincipal() {
    console.log("El ataque principal es Lanzallamas");
  },
};
const Pokemon2 = {
  nombre: "Arceus",
  tipo: "Fuego",
  ataques: ["Lanzallamas", "Vuelo"],
  ataquePrincipal() {
    return this.ataques[0];
  },
};
const Pokemon3 = {
  nombre: "Bulbasur",
  tipo: "Fuego",
  ataques: ["Lanzallamas", "Vuelo"],
  ataquePrincipal() {
    console.log("El ataque principal es Lanzallamas");
  },
};
console.log(Pokemon.ataquePrincipal);
//extra
const pokemones = [Pokemon, Pokemon2, Pokemon3];
pokemones.filter((p) => p);
const pokedex = [
  {
    nombre: "Bulbasur",
    nivel: 30,
    tipo: "Fuego",
    ataques: ["Lanzallamas", "Vuelo"],
    ataquePrincipal() {
      return this.ataques[0];
    },
  },
  {
    nombre: "Carambula",
    nivel: 50,
    tipo: "Humo",
    ataques: ["Cigarro", "Muy bien, Muy mal"],
    ataquePrincipal() {
      return this.ataques[0];
    },
  },
  {
    nombre: "Pikachu",
    nivel: 40,
    tipo: "Electrico",
    ataques: ["Impactrueno", "Vuelo"],
    ataquePrincipal() {
      return this.ataques[0];
    },
  },
];
// array.filter devuelve un array con el elemento del array que coincida
console.log(pokedex.filter(p => p.tipo == "Fuego"));
console.log(pokedex.filter(p => p.nivel == 50));
// array.map devuelve un array con lo que se extraiga de la arrow function
console.log(pokedex.map(p => p.nombre.toUpperCase()));
