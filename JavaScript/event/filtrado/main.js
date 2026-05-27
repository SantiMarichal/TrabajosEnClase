const pokedex = [
    {
        nombre: `Charizard`,
        tipo: `icons/fire.svg`
    },
    {
        nombre: `Blastoise`,
        tipo: `icons/water.svg`
    },
    {
        nombre: `Venusaur`,
        tipo: `icons/grass.svg`
    },
    {
        nombre: `Arcanine`,
        tipo: `icons/fire.svg`
    }
];

const botonesFiltro = document.querySelectorAll(`#filtros button`);


botonesFiltro.forEach((btn) => {
    btn.addEventListener(`click` , (e) => {
        console.log(btn.database.tipo);
    });
});