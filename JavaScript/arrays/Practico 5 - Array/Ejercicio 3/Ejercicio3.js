const numeros = [3, 7, 1, 8, 2, 5];
let mayor = numeros[0];
for (let i = 0; i < numeros.length; i++) {
    if (numeros[i] > mayor) {
        mayor = numeros[i];
    }
}
alert("El número mayor es: " + mayor);