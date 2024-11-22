
# Sistema 2025 - Color Digital

Sistema monolito para la gestión de datos de Color Digital utilizando PHP 8.2, Laravel 11, Vue 3, Tailwind 3, MySQL y el stack de Inertia.




## Instalación de dependencias

Recuerda cambiar las variables de entorno que estaran especificadas en .env.example y generar la key, el storage link y correr las migraciones para poder utilizar el sistema:

```bash
  php artisan key:generate
  php artisan storage:link
  php artisan migrate:fresh --seed
```

Se deben de instalar las dependencias requeridas para el funcionamiento del monolito. Correr el comando siguiente para instalar las dependencias requeridas por Laravel: 

```bash
  composer update
```
Instalación de dependencias frontend requeridas por Vue:
```bash
  npm install
```

## Levantamiento de proyecto

Para levantar el proyecto monolito en ambiente local se deben de correr los siguientes comandos de lado del backend:
```bash
  php artisan serve
```

Comando para correr frontend:
```bash
  npm run dev
```
