# Respira y Sigue

Aplicación web construida con Laravel para el seguimiento del bienestar emocional: test de estrés y ansiedad, recomendación de ejercicios, recursos de apoyo, recordatorios diarios y perfil de usuario.

## Requisitos previos

- PHP >= 8.2
- Composer
- MySQL, XAMPP
- Extensiones de PHP activas: pdo_mysql, mbstring

## Instalación

1. Clonar el repositorio:

   git clone https://github.com/tu-usuario/respira-y-sigue.git
   cd respira-y-sigue

2. Instalar las dependencias de PHP:

   composer install

3. Copiar el archivo de configuración de ejemplo:

   copy .env.example .env

   (en Linux/Mac: cp .env.example .env)

4. Generar la clave de la aplicación:

   php artisan key:generate

5. Crear la base de datos en MySQL (por ejemplo, desde MySQL Workbench o consola):

   CREATE DATABASE respira_y_sigue;

6. Editar el archivo .env con los datos de conexión de tu base de datos:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=respira_y_sigue
   DB_USERNAME=root
   DB_PASSWORD=

7. Ejecutar las migraciones (crea todas las tablas):

   php artisan migrate

8. Cargar los datos iniciales (ejercicios y recursos de ejemplo):

   php artisan db:seed --class=EjercicioSeeder
   php artisan db:seed --class=RecursoSeeder

9. Levantar el servidor local:

   php artisan serve

10. Abrir en el navegador: http://127.0.0.1:8000

## Funcionalidades

- Registro e inicio de sesión de usuarios
- Perfil editable (datos personales y contraseña)
- Test emocional (estrés y ansiedad) con recomendación de ejercicios
- Catálogo de ejercicios filtrable por categoría, con registro de completado
- Recursos de apoyo (artículos, lecturas, videos, audios)
- Recordatorios personalizados
- Panel de inicio con estado de ánimo diario, frase del día y progreso semanal

## Tecnologías

- Laravel 13
- PHP 8.5
- MySQL
- Blade (plantillas)

## Nota sobre los datos

Al clonar este repositorio, la base de datos se crea vacía (solo con la estructura de tablas y el contenido de ejemplo de ejercicios/recursos). Los usuarios, tests y recordatorios se generan al usar Respira y Sigue.

## Autores

Sebastian Robles
Jeison Avila
Sebastian Amaya
Liviston Palacios