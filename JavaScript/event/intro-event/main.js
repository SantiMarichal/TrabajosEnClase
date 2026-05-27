document.querySelector(`#btn-prueba`).addEventListener(`click`, (e) => {
    console.log(e.type);
    console.log(e.target);
    console.log(e.currentTarget);
});
