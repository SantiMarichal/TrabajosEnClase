const formulario = document.getElementById('loginForm');

const mensaje = document.getElementById('mensaje');

formulario.addEventListener('submit', async (e) => {
    e.preventDefault();

    const user = document.getElementById('usuario').value;
    const pass = document.getElementById('password').value;

    try {
        const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user: user,
                    pass: pass
                })
            }
        );

        const datos = await response.json();

        if (!response.ok) {
            mensaje.textContent = datos.error;
            return;
        }


        console.log('Usuario:', datos.usuario);
        console.log('Usuario:', datos.usuario.rol);
        localStorage.setItem('usuario_ci', datos.usuario.ci);
        // ('usuario_ci');

        if (datos.usuario.rol === "admin") {
            window.location.href = '/frontend/html/usuarios.html';
        }
        if (datos.usuario.rol === "user") {
            window.location.href = '/frontend/html/pokemon.html';
        }
    } catch (error) {
        console.error(error);
        mensaje.textContent = 'Error de conexión';
    }
});

async function obtenerCI(user) {
    try {
        const response = await fetch('/api/login');

        const datos = await response.json();

        if (!response.ok) {
            mensaje.textContent = datos.error;
            return;
        }


        console.log('Usuario:', datos.usuario);
        console.log('Usuario:', datos.usuario.rol);

        if (datos.usuario.rol === "admin") {
            window.location.href = '/frontend/html/usuarios.html';
        }
        if (datos.usuario.rol === "user") {
            window.location.href = '/frontend/html/pokemon.html';
        }
    } catch (error) {
        console.error(error);
        mensaje.textContent = 'Error de conexión';
    }
}