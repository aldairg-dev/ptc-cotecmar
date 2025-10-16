# 🗄️ Estructura de Base de Datos - Sistema COTECMAR

![Database Schema](../docs/images/database-schema.png)

## 📋 Descripción General

La base de datos del Sistema de Gestión de Minucia utiliza **SQLite** como motor principal, diseñada para manejar la estructura jerárquica de proyectos navales en COTECMAR.

## 🏗️ Arquitectura de Datos

```
users (Tabla 1)
│
├── proyectos (Tabla 2)
│   │
│   ├── bloques (Tabla 3)
│   │   │
│   │   └── piezas (Tabla 4) ⭐ TABLA PRINCIPAL
│
└── registros_minucia (logs de auditoría)
```

## 📊 Tablas Principales

### 1. 👥 users (Usuarios del Sistema)

**Propósito**: Gestión de usuarios autenticados del sistema

```sql
CREATE TABLE users (
    id                  BIGINT PRIMARY KEY,
    name               VARCHAR(255) NOT NULL,
    email              VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at  TIMESTAMP NULL,
    password           VARCHAR(255) NOT NULL,
    two_factor_secret  TEXT NULL,
    two_factor_recovery_codes TEXT NULL,
    two_factor_confirmed_at TIMESTAMP NULL,
    remember_token     VARCHAR(100) NULL,
    current_team_id    BIGINT NULL,
    profile_photo_path VARCHAR(2048) NULL,
    created_at         TIMESTAMP NULL,
    updated_at         TIMESTAMP NULL
);
```

**Usuarios de Prueba**:
- `admin@cotecmar.com` / `password123` (Administrador)
- `operador@cotecmar.com` / `password123` (Operador)

![Users Table](../docs/images/users-table.png)

---

### 2. 🚢 proyectos (Proyectos Navales)

**Propósito**: Proyectos principales de construcción naval

```sql
CREATE TABLE proyectos (
    id           BIGINT PRIMARY KEY,
    nombre       VARCHAR(255) NOT NULL,
    descripcion  TEXT NULL,
    codigo       VARCHAR(50) UNIQUE NOT NULL,
    fecha_inicio DATE NULL,
    fecha_fin    DATE NULL,
    estado       ENUM('activo', 'inactivo', 'completado') DEFAULT 'activo',
    created_at   TIMESTAMP NULL,
    updated_at   TIMESTAMP NULL
);
```

**Datos de Ejemplo**:
- **FRAG** - Proyecto Fragata
- **BICM** - Buque Oceanográfico 
- **BALC** - Buque de Apoyo Logístico

![Projects Table](../docs/images/projects-table.png)

---

### 3. 🧱 bloques (Bloques por Proyecto)

**Propósito**: Secciones o módulos de cada proyecto naval

```sql
CREATE TABLE bloques (
    id           BIGINT PRIMARY KEY,
    nombre       VARCHAR(255) NOT NULL,
    descripcion  TEXT NULL,
    codigo       VARCHAR(50) NOT NULL,
    proyecto_id  BIGINT NOT NULL,
    estado       ENUM('activo', 'inactivo', 'completado') DEFAULT 'activo',
    created_at   TIMESTAMP NULL,
    updated_at   TIMESTAMP NULL,
    
    FOREIGN KEY (proyecto_id) REFERENCES proyectos(id) ON DELETE CASCADE
);
```

**Estructura Jerárquica**:
```
FRAG (Fragata)
├── B001 - Casco Principal
├── B002 - Superestructura
└── B003 - Sistema de Propulsión

BICM (Oceanográfico)
├── B001 - Casco Principal  
├── B002 - Laboratorios
└── B003 - Sistema de Navegación
```

![Blocks Table](../docs/images/blocks-table.png)

---

### 4. ⚙️ piezas (Piezas Individuales) ⭐ **TABLA PRINCIPAL**

**Propósito**: Piezas específicas a fabricar con control de peso y calidad

```sql
CREATE TABLE piezas (
    id             BIGINT PRIMARY KEY,
    nombre         VARCHAR(255) NOT NULL,
    descripcion    TEXT NULL,
    codigo         VARCHAR(50) NOT NULL,
    idpieza        VARCHAR(20) NOT NULL,     -- P001, P002, etc.
    pieza          VARCHAR(10) NOT NULL,     -- A01, B02, etc.
    bloque_id      BIGINT NOT NULL,
    proyecto_id    BIGINT NOT NULL,
    peso_teorico   DECIMAL(10,3) NOT NULL,   -- Peso de diseño
    peso_real      DECIMAL(10,3) NULL,       -- Peso medido (cuando se fabrica)
    diferencia_peso DECIMAL(10,3) NULL,      -- peso_real - peso_teorico
    material       VARCHAR(255) NULL,
    estado         ENUM('Pendiente', 'Fabricado', 'Otro') DEFAULT 'Pendiente',
    fecha_registro TIMESTAMP NULL,           -- Cuando se registra el peso real
    user_id        BIGINT NULL,             -- Usuario que registró
    observaciones  TEXT NULL,
    created_at     TIMESTAMP NULL,
    updated_at     TIMESTAMP NULL,
    
    FOREIGN KEY (bloque_id) REFERENCES bloques(id) ON DELETE CASCADE,
    FOREIGN KEY (proyecto_id) REFERENCES proyectos(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
```

**Estados de Pieza**:
- `Pendiente` - Esperando fabricación
- `Fabricado` - Completada con peso registrado
- `Otro` - Estado especial

![Pieces Table](../docs/images/pieces-table.png)

---

## 🔗 Relaciones entre Tablas

### Diagrama ER
```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│    users    │    │  proyectos  │    │   bloques   │    │   piezas    │
├─────────────┤    ├─────────────┤    ├─────────────┤    ├─────────────┤
│ id (PK)     │    │ id (PK)     │    │ id (PK)     │    │ id (PK)     │
│ name        │    │ nombre      │    │ nombre      │    │ nombre      │
│ email       │    │ codigo      │    │ codigo      │    │ codigo      │
│ password    │    │ estado      │    │ proyecto_id │◄───┤ bloque_id   │
└─────────────┘    └─────────────┘    │ estado      │    │ proyecto_id │
       ▲                   ▲          └─────────────┘    │ peso_teorico│
       │                   │                   ▲         │ peso_real   │
       └───────────────────┼───────────────────┘         │ estado      │
                           │                             │ user_id (FK)│
                           └─────────────────────────────►└─────────────┘
```

### Relaciones Implementadas

1. **users → piezas** (1:N)
   - Un usuario puede registrar múltiples piezas
   - Una pieza es registrada por un usuario

2. **proyectos → bloques** (1:N)  
   - Un proyecto tiene múltiples bloques
   - Un bloque pertenece a un proyecto

3. **bloques → piezas** (1:N)
   - Un bloque contiene múltiples piezas
   - Una pieza pertenece a un bloque

4. **proyectos → piezas** (1:N)
   - Relación directa para consultas rápidas
   - Una pieza pertenece a un proyecto

![Database Relations](../docs/images/database-relations.png)

---

## 🛠️ Migraciones

### Archivos de Migración

```
database/migrations/
├── 2014_10_12_000000_create_users_table.php
├── 2014_10_12_100000_create_password_reset_tokens_table.php
├── 2014_10_12_200000_add_two_factor_columns_to_users_table.php
├── 2019_08_19_000000_create_failed_jobs_table.php
├── 2019_12_14_000001_create_personal_access_tokens_table.php
├── 2025_10_15_192759_create_sessions_table.php
├── 2025_10_15_194842_create_proyectos_table.php
├── 2025_10_15_194843_create_bloques_table.php
└── 2025_10_15_194908_create_piezas_table.php ⭐
```

### Comandos de Migración

```bash
# Ejecutar todas las migraciones
php artisan migrate

# Resetear base de datos con datos de prueba
php artisan migrate:fresh --seed

# Ver estado de migraciones
php artisan migrate:status

# Rollback última migración
php artisan migrate:rollback
```

---

## 🌱 Seeders (Datos de Prueba)

### Archivos de Seeder

```
database/seeders/
├── DatabaseSeeder.php
├── UserSeeder.php
├── ProyectoSeeder.php
├── BloqueSeeder.php
└── PiezaSeeder.php
```

### Datos Incluidos

**3 Proyectos Navales**:
- FRAG - Fragata (3 bloques, 5 piezas)
- BICM - Buque Oceanográfico (2 bloques, 4 piezas)  
- BALC - Buque de Apoyo (2 bloques, 4 piezas)

**13 Piezas Totales**:
- Algunas en estado "Pendiente" (para demostrar formulario)
- Algunas en estado "Fabricado" (para demostrar reportes)

### Ejecutar Seeders

```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar seeder específico
php artisan db:seed --class=PiezaSeeder

# Regenerar datos de prueba
php artisan migrate:fresh --seed
```

![Seeders Data](../docs/images/seeders-data.png)

---

## 📊 Consultas SQL Comunes

### 1. Piezas Pendientes por Proyecto
```sql
SELECT 
    p.nombre as proyecto,
    b.nombre as bloque,
    pz.codigo,
    pz.nombre as pieza,
    pz.peso_teorico
FROM piezas pz
JOIN bloques b ON pz.bloque_id = b.id
JOIN proyectos p ON pz.proyecto_id = p.id
WHERE pz.estado = 'Pendiente'
ORDER BY p.nombre, b.nombre, pz.codigo;
```

### 2. Estadísticas por Proyecto
```sql
SELECT 
    p.nombre,
    COUNT(pz.id) as total_piezas,
    SUM(CASE WHEN pz.estado = 'Pendiente' THEN 1 ELSE 0 END) as pendientes,
    SUM(CASE WHEN pz.estado = 'Fabricado' THEN 1 ELSE 0 END) as fabricadas
FROM proyectos p
LEFT JOIN piezas pz ON p.id = pz.proyecto_id
GROUP BY p.id, p.nombre;
```

### 3. Diferencias de Peso Significativas
```sql
SELECT 
    p.nombre as proyecto,
    pz.codigo,
    pz.nombre as pieza,
    pz.peso_teorico,
    pz.peso_real,
    pz.diferencia_peso,
    ABS(pz.diferencia_peso / pz.peso_teorico * 100) as porcentaje_diferencia
FROM piezas pz
JOIN proyectos p ON pz.proyecto_id = p.id
WHERE pz.peso_real IS NOT NULL
AND ABS(pz.diferencia_peso / pz.peso_teorico * 100) > 5
ORDER BY porcentaje_diferencia DESC;
```

---

## 🔧 Mantenimiento de Base de Datos

### Backup
```bash
# Crear backup de la base de datos
cp database/database.sqlite database/backup_$(date +%Y%m%d_%H%M%S).sqlite

# Restaurar backup
cp database/backup_20241015_120000.sqlite database/database.sqlite
```

### Limpieza
```bash
# Limpiar registros antiguos (conservar últimos 30 días)
php artisan tinker
>>> Pieza::where('fecha_registro', '<', now()->subDays(30))->delete();
```

### Optimización
```bash
# Verificar integridad de la base de datos
sqlite3 database/database.sqlite "PRAGMA integrity_check;"

# Optimizar base de datos
sqlite3 database/database.sqlite "VACUUM;"
```

---

## 📈 Índices para Rendimiento

```sql
-- Índices automáticos por Laravel
CREATE INDEX idx_piezas_proyecto_id ON piezas(proyecto_id);
CREATE INDEX idx_piezas_bloque_id ON piezas(bloque_id);
CREATE INDEX idx_piezas_estado ON piezas(estado);
CREATE INDEX idx_piezas_fecha_registro ON piezas(fecha_registro);

-- Índices compuestos recomendados
CREATE INDEX idx_piezas_proyecto_estado ON piezas(proyecto_id, estado);
CREATE INDEX idx_piezas_bloque_estado ON piezas(bloque_id, estado);
```

---

## 🔍 Herramientas de Inspección

### Laravel Tinker
```bash
php artisan tinker

# Explorar datos
>>> User::count()
>>> Proyecto::with('bloques.piezas')->get()
>>> Pieza::where('estado', 'Pendiente')->count()
```

### Herramientas SQLite
```bash
# Conectar a la base de datos
sqlite3 database/database.sqlite

# Listar tablas
.tables

# Describir estructura de tabla
.schema piezas

# Consultar datos
SELECT * FROM piezas LIMIT 5;
```

### DB Browser para SQLite
- **Recomendación**: Usar [DB Browser for SQLite](https://sqlitebrowser.org/) para inspección visual
- Permite navegar, editar y consultar la base de datos gráficamente

![DB Browser](../docs/images/db-browser.png)

---

## 🔙 Volver al README Principal

← [README Principal](../README.md)

---

<div align="center">
  <strong>🗄️ Base de Datos - Sistema COTECMAR 🗄️</strong>
</div>
