let usuarioActual = null;

document.addEventListener('DOMContentLoaded', cargarSesion);

async function cargarSesion() {
    try {
        const response = await fetch('/api/sesion');

        const datos = await response.json();

        if (!datos.autenticado) {
            window.location.href = '/frontend/index.html';
            return;
        }

        usuarioActual = datos.usuario;

        document.getElementById('nombreUsuario').textContent = usuarioActual.nombre;

        document.getElementById('rolUsuario').textContent = usuarioActual.rol;

    } catch (error) {
        console.error(error);
    }
}

document.getElementById('btnLogout').addEventListener('click', logout);

async function logout() {
    try {
        await fetch('/api/logout', {
            method: 'POST'
        });

        localStorage.clear();
        window.location.href = '/frontend/index.html';

    } catch (error) {
        console.error(error);
    }
}

