// 1) querySelector
document.querySelector(`#btn`).addEventListener(`click`, () => {
    alert(`Primer boton`);
});

document.querySelector(`.btn`).addEventListener(`click`, () => {
    alert(`Segundo boton`);
});
// 2) InnerHTML y appendChild

document.querySelector(`#contenedorInnerHTML`).innerHTML = `<h3>Borramos</h3>`;

const contenedorInnerHTML = document.querySelector(`#contenedorInnerHTML`);
contenedorInnerHTML.innerHTML = `<h3>Borramos x 2</h3>`;

const txtXSS = document.querySelector(`#xss`);
txtXSS.addEventListener(`keydown`, (e) => {
    if (e.key === `Enter`)
        document.querySelector(`#txtXSS`).textContent = `Hola, ${txtXSS.value}`;
        //document.querySelector(`#txtXSS`).innerHTML = `Hola, ${txtXSS.value}`;
});

// 3) createElement y appendChild

const contenedor = document.querySelector(`#createElem`);

const card = document.createElement(`div`);

card.style.backgroundColor = `red`;
const titulo = document.createElement(`h3`);
titulo.textContent = `Soy un h3 creador de forma dinámica`

card.appendChild(titulo);
contenedor.appendChild(card);

// 1. Crear elementos
const card2 = document.createElement('div');
const img2 = document.createElement('img');
const nombre2 = document.createElement('h3');
// 2. Configurar contenido
img2.src = 'pikachu.png';
nombre2.textContent = 'Pikachu';
// 3. Agregar estilos
card2.classList.add('pokemon-card');
// 4. Construir estructura
card2.appendChild(img2);
card2.appendChild(nombre2);
// 5. Agregar al DOM
document.querySelector('#createElem').appendChild(card2);
const botonFav = document.querySelector('#btn-favorito');
const textPikachu = document.querySelector('#card-pikachu');
botonFav.addEventListener('click', () => {
    textPikachu.classList.toggle('favorito');
    if(textPikachu.classList.contains('favorito'))
    botonFav.textContent = 'Favorito';
    else
    botonFav.textContent = 'Favorito';
});



