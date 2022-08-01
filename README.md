## Requisitos del proyecto

- Contar con un entorno de desarrollo como [Laragon], Wampp o Xampp.(https://laragon.org/download/).
- Tener instalado [Node.js](https://getcomposer.org/download/).
- [Tener instalado [Composer] de manera global(https://laravel.com/docs/container).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 1. Instalar dependencias con Composer

Nos ubicamos en la carpeta raíz de nuestro proyecto Laravel, abrimos una terminal y escribimos el siguiente comando:

composer install

Con esta instrucción Composer irá al archivo composer.json e instalará de forma individual cada dependencia que en él están listadas.

## 2. Crear un nuevo archivo .env

Cuando clonamos el proyecto de Laravel desde github, el archivo .env no se agrega al proyecto por temas de seguridad, es por eso que al clonar un proyecto es necesario generar un archivo nuevo. Para ello, escribimos en la terminal:

cp .env.example .env

Este comando creará una copia del archivo .env.example llamando al nuevo .env, es necesario que le agreguemos la información de la base de datos utilizada para el desarrollo de la aplicación, sustituyendo la que se encuentra en el archivo por la siguiente:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todoapp
DB_USERNAME=root
DB_PASSWORD=

### 3. Generamos una key nueva

Desde nuestra terminal escribimos el comando:

php artisan key:generate

y se creará una clave única que es necesaria para que nuestra app funcione.

## 4. Creamos la base de datos

Ahora toca crear la base de datos a la cual nuestra aplicación se estará conectando, para ello nos dirigimos al administrador de base de datos y la creamos.

Para este paso se utiliza el archivo .sql que les fue suministrado.

## 5. Corremos las migraciones

Una vez más desde nuestra terminal escribimos el comando:

php artisan migrate

con esto todas las tablas que necesita nuestra aplicación se generarán y agregarán a la base de datos.

## Listo para probar el proyecto

¡Y listo! Ya pudimos clonar nuestro proyecto Laravel de manera fácil y rápida.