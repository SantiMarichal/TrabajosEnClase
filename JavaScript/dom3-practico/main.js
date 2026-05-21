const pikachu = {
    nombre: "Pikachu",
    tipo: "Electrico",
    imagen: "pikachu.png",
    habilidades: ["Impactrueno", "Rayo"]
}

// 1. Crear elementos
const card = document.createElement('div');
const img = document.createElement('img');
const nombre = document.createElement('h3');
const span = document.createElement('span');
// 2. Configurar contenido
img.src = 'pikachu.png';
nombre.textContent = pikachu.nombre;
span.textContent = pikachu.tipo; 
// 3. Agregar estilos
card.classList.add('pokemon-card');
span.classList.add('tipo-electrico');
// 4. Construir estructura
card.appendChild(img);
card.appendChild(nombre);
card.appendChild(span);
document.querySelector(`#contenedor-pokemon`).appendChild(card);

