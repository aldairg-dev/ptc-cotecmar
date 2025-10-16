# 🚀 Manual de Instalación - Sistema COTECMAR

## 📋 Prerrequisitos del Sistema

### Verificación de Versiones Requeridas

```bash
# PHP >= 8.1
php --version

# Composer (Gestor de dependencias PHP)
composer --version

# Node.js >= 16
node --version

# NPM (Gestor de dependencias JavaScript)  
npm --version

# Git (Control de versiones)
git --version
```

### Instalación de Prerrequisitos

#### En Windows:
```bash
# Instalar PHP (usando Chocolatey)
choco install php

# Instalar Composer
choco install composer

# Instalar Node.js
choco install nodejs

# Instalar Git
choco install git
```

#### En macOS:
```bash
# Instalar PHP (usando Homebrew)
brew install php

# Instalar Composer
brew install composer

# Instalar Node.js
brew install node

# Instalar Git  
brew install git
```

#### En Ubuntu/Debian:
```bash
# Actualizar repositorios
sudo apt update

# Instalar PHP y extensiones
sudo apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath php8.1-sqlite3

# Instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Instalar Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Instalar Git
sudo apt install git
```

---

## 📦 Instalación del Proyecto

### 1. Clonar el Repositorio

```bash
# Clonar desde el repositorio
git clone [URL_DEL_REPOSITORIO]
cd ptc-cotecmar

# O descargar ZIP y extraer
# Navegar al directorio extraído
```

### 2. Instalar Dependencias PHP

```bash
# Instalar paquetes PHP con Composer
composer install

# Si hay problemas con memoria
composer install --no-dev --optimize-autoloader
```

### 3. Instalar Dependencias JavaScript

```bash
# Instalar paquetes Node.js con NPM
npm install

# O usar Yarn si prefieres
yarn install
```

### 4. Configuración del Entorno

```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación Laravel
php artisan key:generate
```

### 5. Configurar Base de Datos

Editar el archivo `.env`:

```env
# Configuración de base de datos SQLite
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/completa/al/proyecto/database/database.sqlite

# En Windows (ejemplo):
# DB_DATABASE=C:\Users\TuUsuario\Documentos\ptc-cotecmar\database\database.sqlite

# En Linux/macOS (ejemplo):
# DB_DATABASE=/home/tuusuario/ptc-cotecmar/database/database.sqlite
```

### 6. Crear Base de Datos y Ejecutar Migraciones

```bash
# Crear archivo de base de datos SQLite
touch database/database.sqlite

# En Windows usar:
# type nul > database\database.sqlite

# Ejecutar migraciones y seeders
php artisan migrate:fresh --seed
```

### 7. Compilar Assets

```bash
# Para desarrollo (con hot reload)
npm run dev

# Para producción (archivos optimizados)
npm run build
```

### 8. Iniciar Servidor

```bash
# Iniciar servidor de desarrollo Laravel
php artisan serve

# El sitio estará disponible en:
# http://127.0.0.1:8000
```

---

## 🔧 Configuración Avanzada

### Configuración de Permisos (Linux/macOS)

```bash
# Dar permisos de escritura a directorios necesarios
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod 664 database/database.sqlite

# Cambiar propietario (opcional)
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
```

### Configuración del Servidor Web

#### Apache (.htaccess ya incluido)
```apache
# Asegurar que mod_rewrite esté habilitado
sudo a2enmod rewrite
sudo systemctl restart apache2

# Document root debe apuntar a /public
DocumentRoot "/ruta/al/proyecto/public"
```

#### Nginx
```nginx
server {
    listen 80;
    server_name tu-dominio.com;
    root /ruta/al/proyecto/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 🐛 Solución de Problemas Comunes

### Error: "Class not found"
```bash
# Regenerar autoloader
composer dump-autoload
```

### Error: "Permission denied" en storage
```bash
# Linux/macOS
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache

# Windows (ejecutar como administrador)
icacls storage /grant Everyone:F /T
```

### Error: "Database not found"
```bash
# Verificar que existe el archivo
ls -la database/database.sqlite

# Si no existe, crearlo
touch database/database.sqlite

# Verificar permisos
chmod 664 database/database.sqlite
```

### Error: "Node modules not found"
```bash
# Limpiar cache de npm
npm cache clean --force

# Reinstalar dependencias
rm -rf node_modules package-lock.json
npm install
```

### Error: "Vite not found"
```bash
# Instalar Vite globalmente
npm install -g vite

# O usar npx
npx vite build
```

### Error: "CSRF token mismatch"
```bash
# Limpiar cache de Laravel
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Error de memoria en Composer
```bash
# Aumentar límite de memoria temporalmente
composer install --no-dev --optimize-autoloader

# O configurar php.ini
memory_limit=512M
```

---

## ✅ Verificación de Instalación

### Checklist de Verificación

```bash
# 1. Verificar PHP y extensiones
php -m | grep -E "(pdo_sqlite|mbstring|json|openssl|tokenizer|xml)"

# 2. Verificar Composer
composer --version

# 3. Verificar Node.js y NPM
node --version && npm --version

# 4. Verificar base de datos
php artisan migrate:status

# 5. Verificar assets compilados
ls -la public/build/

# 6. Verificar servidor
curl -I http://127.0.0.1:8000
```

### Pruebas de Funcionalidad

1. **Acceso al sistema**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
2. **Login**: `admin@cotecmar.com` / `password123`
3. **Dashboard**: Verificar estadísticas
4. **Registro**: Crear nuevo registro de pieza
5. **Reportes**: Verificar datos en reportes

---

## 🔄 Comandos de Mantenimiento

### Actualización del Sistema

```bash
# Actualizar dependencias PHP
composer update

# Actualizar dependencias JavaScript
npm update

# Ejecutar nuevas migraciones
php artisan migrate

# Recompilar assets
npm run build
```

### Backup y Restauración

```bash
# Crear backup de base de datos
cp database/database.sqlite database/backup_$(date +%Y%m%d_%H%M%S).sqlite

# Backup completo del proyecto
tar -czf cotecmar_backup_$(date +%Y%m%d).tar.gz --exclude=node_modules --exclude=vendor .

# Restaurar backup de base de datos
cp database/backup_20241015_120000.sqlite database/database.sqlite
```

### Reset Completo

```bash
# Limpiar todo y empezar de nuevo
php artisan migrate:fresh --seed
npm run build
php artisan cache:clear
```

---

## 🚀 Despliegue en Producción

### Preparación para Producción

```bash
# 1. Configurar entorno de producción
cp .env .env.backup
nano .env

# Configurar:
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error

# 2. Optimizar autoloader
composer install --no-dev --optimize-autoloader

# 3. Compilar assets optimizados
npm run build

# 4. Optimizar configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Configurar permisos
chmod -R 775 storage bootstrap/cache
```

### Variables de Entorno Importantes

```env
# Configuración de aplicación
APP_NAME="Sistema COTECMAR"
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://tu-dominio.com

# Base de datos
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/database/database.sqlite

# Mail (opcional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-password
MAIL_ENCRYPTION=tls

# Logs
LOG_CHANNEL=daily
LOG_LEVEL=error
```

---

## 📞 Soporte

### En caso de problemas:

1. **Verificar logs**: `tail -f storage/logs/laravel.log`
2. **Consultar documentación**: [Laravel Docs](https://laravel.com/docs)
3. **Verificar versiones**: Asegurar compatibilidad de versiones
4. **Contactar soporte**: [contacto@email.com]

### Archivos de Log Importantes

```bash
# Logs de Laravel
storage/logs/laravel.log

# Logs del servidor web
# Apache: /var/log/apache2/error.log
# Nginx: /var/log/nginx/error.log

# Logs de PHP
# /var/log/php8.1-fpm.log
```

---

## ← Volver

← [README Principal](../README.md)

---

<div align="center">
  <strong>🚀 Instalación Exitosa - Sistema COTECMAR 🚀</strong>
</div>
