const tags = ['javascript', 'web', 'programación', 'frontend', 'react'];
// 1) Comprobar que la etiqueta 'python' está presente en el array.
alert("python esta incluido: " + tags.includes("python"));
// 2) Crear un nuevo array llamado 'principales' que contenga solo las 3 primeras etiquetas.
const principales = tags.slice(0 , 3);
alert("El nuevo array es: " + principales);
// 3) Convertir el array 'principales en un solo string separado por comas y espacios.
alert("Nuevo string: " + principales.join(", "));
