const palabras = ['sol', 'javascript', 'pc', 'desarrollador', 'code'];
// 1) ¿Cuántas palabras tienen más de 4 letras?
const palabrasConMasDe4Letras = palabras.filter(p => p.length > 4);
alert("Palabras con más de 4 letras: " + palabrasConMasDe4Letras.length);
// 2) Calcula la suma total de letras de todas las palabras combinadas.
const sumaTotalLetras = palabras.reduce((total, palabra) => total + palabra.length, 0);
alert("Suma total de letras: " + sumaTotalLetras);