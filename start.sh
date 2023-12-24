#!/bin/bash  

cp /var/www/.env.example /var/www/.env
# Cargar las variables de entorno desde el archivo .env
set -a
source /var/www/.env
set +a

# Función para verificar la conexión a la base de datos
check_db_connection() {
    # Intenta realizar una conexión simple con las credenciales de Laravel
    php -r "new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');"
}

# Espera hasta que la base de datos esté lista
# ...

# El resto del script
# Espera hasta que la base de datos esté lista (máximo 30 intentos, intervalo de 1 segundo)
max_attempts=30
count=0

echo "Esperando a que la base de datos esté lista..."

while ! check_db_connection >/dev/null 2>&1; do
    count=$((count+1))
    if [ $count -ge $max_attempts ]; then
        echo "Error: no se pudo conectar con la base de datos después de varios intentos."
        exit 1
    fi
    sleep 1
done

echo "Base de datos lista."

# Ejecutar migraciones
php artisan migrate --force

# Ejecutar seeders
php artisan db:seed --class=UsersTableSeeder --force

# Iniciar Laravel
php artisan serve --host=0.0.0.0