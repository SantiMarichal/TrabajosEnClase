const numeros = [];
//Ingresar numeros
for (let i = 0; i < 10; i++) {
    const numero = parseInt(prompt(`Ingrese el número ${i + 1}:`));
    numeros.push(numero);
}
alert("Los numeros ingresados son:" + numeros);
//Cantidad pares
let Cantidadpares=0;
for (let i = 0; i < numeros.length; i++) {
    if (numeros[i] % 2 === 0) {
        Cantidadpares++;
    }
}
alert("La cantidad de números pares es: " + Cantidadpares);