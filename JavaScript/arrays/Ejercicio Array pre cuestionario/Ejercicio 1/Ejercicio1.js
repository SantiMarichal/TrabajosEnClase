const fila = ['Ana', 'María', 'Juan'];
// 1) Llega un nuevo cliente 'Elena' a la fila.
const nombre="Elena";
fila.push(nombre);
alert("La fila actualmente: " + fila);
// 2) Llega un cliente VIP 'Carmen' que debe ser atendida primero.
const VIP="Carmen";
fila.unshift(VIP);
alert("La fila actualmente: " + fila);
// 3) Se atiende al primer cliente de la fila.
fila.splice(0, 1);
alert("La fila actualmente: " + fila);
// 4) Mostrar en consola quién es la última persona en la fila actualmente.
alert("La fila actualmente: " + fila.at(-1));

