const notas = [7, 8, 5, 10, 9, 4];
// 1) Crear un array 'aprobados' con las notas mayores o iguales a 6.
const aprobados = notas.filter(p => p >= 6);
alert("Aprobados: " + aprobados);
// 2) Verificar si TODAS las notas del curso son mayores o iguales a 4.
const todosAprobados = notas.every(p => p >= 4);
alert("Todos aprobados: " + todosAprobados);
// 3) Encontrar la primera nota que sea un 10 exacto.
const primeraNota10 = notas.find(p => p === 10);
const primeraNota10Indice = notas.findIndex(p => p === 10);
alert("Primera nota 10: " + primeraNota10);
alert("Índice de la primera nota 10: " + primeraNota10Indice);