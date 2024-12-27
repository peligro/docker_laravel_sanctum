<hr />

<h1>Implementación Laravel Sanctum con Docker y docker-compose sin Sail</h1>
<h1>Aprovisionamiento para despliegue en AWS con EC2 (Elastic Compute Cloud) y RDS (Relational Database Service )</h1>
<h2>PHP 8.3.14</h2>
<h2>Laravel 11.35.0</h2>
<h2>Docker 27.2.0</h2>
<h2>Docker compose 3.8</h2> 
<h3>Todo preparado para implementar un CD/CI bajo algún servidor de integración continua como Jenkins por ejemplo</h3>

#instalar contenedor<br/>
<code>docker-compose up --build</code>
<hr />
#entrar a la consola
<br/>
<code>docker exec -it peligro-laravel-app bash</code>
<hr />
#detener proyecto
<br/>
<code>docker-compose down</code>
<hr/>
#Instalación<br/>
<code>php artisan install:api</code>
<hr/>
#Instalar el paquete tymon/jwt-auth:<br/>
<code>composer require tymon/jwt-auth</code>
<hr/>
#Publicar la configuración de JWT:<br/>
<code>php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"</code>
<hr/>
#Generar la clave secreta JWT:<br/>
<code>php artisan jwt:secret</code>
<hr/>
#Configurar el archivo .env: Asegúrate de que el archivo .env tenga configurado el controlador de autenticación como jwt:<br/>
<code>AUTH_GUARD=api</code>
<hr/>
#Configurar el archivo config/auth.php:<br/>
<code>'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],</code>
<hr/>