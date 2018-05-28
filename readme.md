## Descripción
Nuestro poyecto trata de una página web para desarollar y jugar juegos creados mediante javascript.

Los usuarios verán una lista de juegos que habrán creado otras personas y al jugarlos, al estar logeado podrán obtener logros y dinero para comprar articulos de ese juego o cualquier que use el sistema de logros y productos de la pagina, incluso podrás dejar un comentario de que te a parecido el juego.

También puedes solicitar ser Developer y crear tus propios juegos y ver como disfruta la gente con ellos.

Nosotros como Administradores controlaremos el uso debido de la página y si hayamos un usuario tóxico o un juego inapropiado, será baneado de la página.

## Requisitos
- php 7.0+
- composer
- apache
- mysql

## Instalación (Linux)
- Clonar repositorio:
git clone https://github.com/mcolominas/projecte2018.git

- Acceder a la carpeta:
cd projecte2018

- Instalar el composer:
composer install

- Crear el .env:
cp .env.example .env

- Modificar el .env con la información correcta (BBDD, URL ...).

- Generar una Key privada:
php artisan key:generate

- Establecer que se pueda logear por username, modificar el fichero:
vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
y cambiar el contenido del metodo "username()" de:
return 'email';
a:
return 'name';

- Crear un link simbolico de public/storage a storage/app/public:
php artisan storage:link

- Migrar la BBDD:
php artisan migrate

- Dar permisos necesarios a las carpetas "storage" y "bootstrap/cache":
sudo chown -R www-data storage bootstrap/cache

- Modificar la url del fichero public/js/apiJuego.js y poner la url del dominio correcta que se encuentra en el metodo: "ajaxJuego"
