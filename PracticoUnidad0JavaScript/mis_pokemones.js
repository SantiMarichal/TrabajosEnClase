const nombrePokemon="Pikachu";
const tipo="Electrico";
let nivel=25;
function describirPokemon(nombrePokemon, tipo, nivel){
    return `${nombrePokemon} es de tipo ${tipo} y es nivel ${nivel}`;
}
console.log(describirPokemon(nombrePokemon, tipo, nivel));
const esPokemonFuerte = (nivel) => {
    if (nivel>=30){
        return true;
    }else{
        return false;
    }
}
console.log(esPokemonFuerte(nivel));

const Pokemon = {
    nombre: "Charizard",
    tipo: "Fuego",
    ataques: ["Lanzallamas", "Vuelo"],
    ataquePrincipal(){
        console.log("El ataque principal es Lanzallamas")
    }
};
const Pokemon2 = {
    nombre: "Arceus",
    tipo: "Fuego",
    ataques: ["Lanzallamas", "Vuelo"],
    ataquePrincipal(){
        console.log("El ataque principal es Lanzallamas")
    }
};
const Pokemon3 = {
    nombre: "Bulbasur",
    tipo: "Fuego",
    ataques: ["Lanzallamas", "Vuelo"],
    ataquePrincipal(){
        console.log("El ataque principal es Lanzallamas")
    }
};
console.log(Pokemon.ataquePrincipal);
//extra
const pokemones = [Pokemon, Pokemon2, Pokemon3];
pokemones.filter(p => p)

