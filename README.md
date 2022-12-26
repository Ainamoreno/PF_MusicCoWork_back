## MusicCoWork

### Descripción
Este proyecto consta de la base de datos de un CoWorking para músicos. Consta de las siguientes tablas: roles, users, rooms, room_users, events, event_users.

![image](https://user-images.githubusercontent.com/110055279/209558379-8c3be957-3efb-4489-a869-647eb73d51d1.png)

### Para poder inicializar el proyecto:

- Clonar el repositorio y lanzar el comando `composer install`.
- Para levantar el servidor tenemos que lanzar el comando `php artisan serve`.

### Funcionalidades

#### De usuario:

- Regitrar usuario.
- Inicio de sesión de un usuario.
- Ver datos de un usuario.
- Mostrar todas las salas.
- Reservar una sala.
- Ver reservas del usuario.
- Cancelar la reserva de una sala.
- Ver todos los eventos públicos.
- Reservar la asistencia a un evento.
- Ver las reservas realizadas a los eventos.
- Cerrar sesión del usuario.

#### De un administrador:

- Iniciar sesión como administrador.
- Crear nuevas salas.
- Ocultar salas ya creadas.
- Mostrar a todos los usuarios registrados.
- Ocultar a algún usuario.
- Crear nuevos eventos.
- Ocultar eventos ya creados.
- Visualizar todas las reservas de salas realizadas por los usuarios.
- Visualizar las reservas de asistencia por cada usuario.

