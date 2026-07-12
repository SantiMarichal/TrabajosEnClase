let numeros = [3, 7, 1, 8, 2, 5, 4];
positivos=true;
for (let i = 0; i < numeros.length; i++) {
    if (numeros[i] < 0) {
        positivos=false;
        break;
    }
}
if(positivos){
    alert("Todos los números son positivos");
}else{
    alert("No todos los números son positivos");
}