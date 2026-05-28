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

//Seleccionamos todos los button que estan dentro del contenedor id `filtros`
const botonesFiltro = document.querySelectorAll(`#filtros button`);
//Selecciono la coleccion de divs que tienen la clase pokemon card
const cards = document.querySelectorAll(`.pokemon-card`);

botonesFiltro.forEach((btn) => {
    btn.addEventListener(`click` , (e) => {
        console.log(btn.dataset.tipo);

        const tipoSeleccionado = btn.dataset.tipo;

        //Recorremos la coleccion de las cards
        cards.forEach((card) => {
            if(tipoSeleccionado==card.dataset.tipo || tipoSeleccionado==`todos`){
                //la card que quiero mostrar
                card.style.display=`flex`;
            }else{
                card.style.display=`none`;
            };
        });
    });
});

const inputFiltro = document.querySelector(`#txtFiltro`);

inputFiltro.addEventListener(`input` , () =>{
    const textoFiltro=inputFiltro.value.toLowerCase();
    cards.forEach((card) => {
        if (card.dataset.tipo.includes(textoFiltro) || card.dataset.tipo.includes(`todos`)){
            card.style.display = `flex`;
        }else{
            card.style.display=`none`;
        }


        if(textoFiltro==card.dataset.tipo || textoFiltro==`todos`){
            //la card que quiero mostrar
            card.style.display=`flex`;
        }else{
            card.style.display=`none`;
        };
    });
});