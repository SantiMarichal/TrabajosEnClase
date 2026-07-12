
async function obtenerPokemon(id) {
    try {
      const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
      const data = await response.json();
      console.log(data);
    } catch (error) {
      console.log('ERROR', error);
    }
  }
async function mostrarPokemon(id) {
    try {
      const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
      const pokemon = await response.json();
      
      // Crear card
      const card = document.createElement('div');
      card.classList.add('pokemon-card');
  
      // Crear elementos
      const img = document.createElement('img');
      const nombre = document.createElement('h3');
      const tipo = document.createElement('span');
      const ul = document.createElement('ul');
  
      // Configurar contenido. Ojo: hacer referencia al parámetro
      img.src = pokemon.sprites.other['official-artwork'].front_default;
      const name = pokemon.name;
      nombre.textContent = name.charAt(0).toUpperCase() + name.slice(1);;
      tipo.textContent = pokemon.types[0].type.name;
      tipo.classList.add('tipo-electrico');
  
      // pokemon.habilidades.forEach((hab) => {
      //     console.log(hab);
      //     const li = document.createElement('li');
      //     li.textContent = hab;
      //     ul.appendChild(li);
      // });
  
      // Ensamblar la card
      card.appendChild(img);
      card.appendChild(nombre);
      card.appendChild(tipo);
      card.appendChild(ul);
      document.querySelector('#contenedor-pokemon').appendChild(card);
  
    } catch (error) {
      console.error('ERROR', error);
    }
  }
  //buscar pokemon por numero en pokeapi
  document.querySelector(`#btn-filtro`).addEventListener('click', () => {
    //obtenemos el valor del input y lo convertimos a mayúsculas para que coincida con el nombre del pokemon
    const inputFiltro = document.querySelector(`#txtFiltro`);
    const textoFiltro=inputFiltro.value.toLowerCase();
    //obtenemos el primer elemento hijo del contenedor de pokemon
    const eliminar= document.querySelector('#contenedor-pokemon').firstChild;
    //usamos los conceptos de truthy y falsy para saber si hay un elemento hijo en el contenedor de pokemon
    //truthy son los valores que se consideran verdaderos en un contexto booleano
    //falsy son los valores que se consideran falsos. en este caso, si plan es truthy, significa que hay un elemento hijo en el contenedor de pokemon y lo eliminamos. Si plan es falsy, significa que no hay ningún elemento hijo y no hacemos nada.
    if(eliminar) 
      //si hay un elemento hijo, lo eliminamos
        document.querySelector('#contenedor-pokemon').removeChild(eliminar);
    //llamamos a la función mostrarPokemon con el valor del input como parámetro
        mostrarPokemon(textoFiltro);

  })
    



