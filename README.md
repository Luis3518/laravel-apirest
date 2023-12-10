Documentación de API de Laravel

Esta API proporciona funcionalidades básicas de autenticación y acceso a datos de usuarios. Se compone de dos principales endpoints: uno para el inicio de sesión (login) y otro para obtener la lista de usuarios. La idea de este proyecto es que se pueda utilizar de base para otros endpoints.


Para levantar el proyecto:

{composer install
cp .env.example .env
php artisan migrate
php artisan db:seed --class=UsersTableSeeder

php artisan serve}



Autenticación (Login)

    URL: http://127.0.0.1:8000/api/login
    Método: POST
    Cuerpo de la solicitud (Body):

    json

    {
      "email": "luis@ex.com",
      "password": "123456"
    }

    Descripción: Este endpoint permite a los usuarios iniciar sesión. Al proporcionar un email y una contraseña válidos, el usuario recibirá un token de acceso.

Obtener Usuarios

    URL: http://127.0.0.1:8000/api/users
    Método: GET
    Headers:
        Authorization: Bearer [TOKEN]
        Reemplaza [TOKEN] con el token obtenido en el login.
    Descripción: Este endpoint devuelve una lista de todos los usuarios. Requiere autenticación mediante un token válido, que se obtiene a través del endpoint de login.

Usuarios Válidos

    Descripción: La lista de usuarios válidos se puede encontrar en los seeders de la base de datos. Estos usuarios se pueden utilizar para probar el inicio de sesión.
    Nota: Consulte el archivo de seeders (UsersTableSeeder.php) para ver la lista de usuarios y sus credenciales.

Notas Adicionales

    Asegúrese de que su servidor local esté en ejecución (php artisan serve) para acceder a estos endpoints.
    Para probar la API, puede usar herramientas como Postman o cURL.
    Recuerde actualizar las credenciales en los ejemplos de acuerdo con los usuarios definidos en sus seeders.

Esta documentación provee una guía básica para interactuar con tu API. Dependiendo del público objetivo (desarrolladores, usuarios finales, etc.), podrías querer añadir más detalles o explicaciones sobre cómo instalar y configurar el entorno necesario para utilizar la API.