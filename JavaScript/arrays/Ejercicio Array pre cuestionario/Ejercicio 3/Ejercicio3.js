const productos = ['Teclado', 'Mouse', 'Agotado', 'Monitor'];
// 1) Encontrar el índice dónde se ubica el producto 'Agotado'.
const indice = productos.findIndex(p => p === "Agotado");
alert("El indice es: " + indice);
// 2) Reemplazar 'Agotado' por 'Camara Web' (del array productos).
const productos2 = productos.slice(); // Crear una copia del array
productos2.splice(2, 1, "Camara Web");
alert("Nuevo array: " + productos2);
// 3) Invertir el orden de la lista completa para mostrar los últimos ingresados primero.
alert("Array invertido: " + productos2.reverse());