console.log("Hola Mundo");

let saludo = "Hola mundo let";
let num = 67;
let num_coma = 6.9;
let existe = true;

console.log("Variable Saludo" + ": " + saludo + " " + (typeof saludo));
console.log("Variable Num" + ": " + num + " " + (typeof num));
console.log("Variable Num Coma" + ": " + num_coma + " " + (typeof num_coma));
console.log("Variable Existente" + ": " + existe + " " + (typeof existe));

/* typeof es una funcion que nos indica el tipo de dato de la variable en ese momento de ejecucion */

const parrafo = document.getElementById("txt");

parrafo.textContent = "Cambiando texto desde JavaScript";

const boton = document.getElementById("btn");
boton.addEventListener("click", () => (
    parrafo.textContent="Cambiando texto con un botòn en JS"
));

document.getElementById("btn-error").addEventListener("click" , () => {alert("Error 666")
});
