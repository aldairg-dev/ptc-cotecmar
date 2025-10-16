# 👥 Manual de Usuario - Sistema COTECMAR

![User Guide Header](./images/user-guide-header.png)

## 📋 Introducción

Bienvenido al **Sistema de Gestión de Minucia de COTECMAR**. Este manual te guiará paso a paso para usar todas las funcionalidades del sistema de manera eficiente.

## 🎯 Objetivo del Sistema

El sistema permite registrar y controlar piezas navales durante el proceso de fabricación, comparando el peso real medido con las especificaciones teóricas del diseño.

---

## 🔐 Acceso al Sistema

### 1. Iniciar Sesión

1. **Abrir navegador** y dirigirse a la URL del sistema
2. **Introducir credenciales** en la página de login

![Login Process](./images/login-process.png)

#### Usuarios de Prueba Disponibles:

| Rol | Email | Contraseña | Permisos |
|-----|-------|------------|----------|
| **Administrador** | admin@cotecmar.com | password123 | Acceso completo |
| **Operador** | operador@cotecmar.com | password123 | Registro de piezas |

### 2. Página de Inicio (Dashboard)

Después del login exitoso, serás redirigido al **Dashboard** donde podrás ver:

- 📊 **Estadísticas generales** del sistema
- 📈 **Gráfico de progreso** por proyecto  
- 🔗 **Enlaces rápidos** a funciones principales
- 📋 **Lista de piezas pendientes**

![Dashboard Overview](./images/dashboard-overview.png)

---

## 📝 Registro de Nueva Pieza

### Acceder al Formulario

Desde el Dashboard o menú principal:
1. Click en **"Nuevo Registro"** 
2. O navegar a **Minucia → Registro**

### Completar el Formulario

![Registration Form Steps](./images/registration-form-steps.png)

#### Paso 1: Información Automática
- ✅ **Fecha y Hora**: Se llena automáticamente
- ✅ **Usuario**: Muestra tu nombre de usuario actual

#### Paso 2: Selección de Proyecto
1. **Seleccionar Proyecto** desde el dropdown
   - FRAG (Fragata)
   - BICM (Buque Oceanográfico)  
   - BALC (Buque de Apoyo Logístico)

#### Paso 3: Selección de Bloque
1. **Esperar** que se carguen los bloques automáticamente
2. **Seleccionar Bloque** correspondiente al proyecto

#### Paso 4: Selección de Pieza
1. **Esperar** que se carguen las piezas disponibles
2. **Seleccionar Pieza** a registrar
   - Solo se muestran piezas en estado **"Pendiente"**
   - El peso teórico se carga automáticamente

#### Paso 5: Registro de Peso
1. **Peso Teórico**: Se muestra automáticamente (no editable)
2. **Peso Real**: Introducir el peso medido
   - Usar números decimales (ej: 2500.450)
   - El sistema calculará automáticamente la diferencia

#### Paso 6: Observaciones (Opcional)
- Agregar notas adicionales sobre la pieza
- Comentarios sobre el proceso de fabricación
- Observaciones de calidad

#### Paso 7: Guardar Registro
1. **Verificar** todos los datos ingresados
2. Click en **"Guardar Registro"**
3. El sistema confirmará el guardado exitoso

### Resultado del Registro

Al guardar exitosamente:
- ✅ La pieza cambia de estado **"Pendiente"** a **"Fabricado"**
- ✅ Se registra fecha/hora y usuario que realizó el registro
- ✅ Se calcula y guarda la diferencia de peso
- ✅ Redirección automática al listado de registros

![Registration Success](./images/registration-success.png)

---

## 📋 Consultar Registros Históricos

### Acceso al Listado

1. Desde el menú principal: **"Ver Registros"**
2. O navegar a **Minucia → Registros**

### Funcionalidades del Listado

![Records List](./images/records-list.png)

#### Tabla de Registros
- **Código**: Identificación de la pieza
- **Proyecto**: Nombre del proyecto naval
- **Bloque**: Sección del proyecto
- **Pieza**: Nombre de la pieza fabricada
- **Peso Teórico**: Peso de diseño (kg)
- **Peso Real**: Peso medido (kg)
- **Diferencia**: Variación entre pesos
- **Estado**: Estado actual de la pieza
- **Fecha**: Cuándo se registró
- **Usuario**: Quién realizó el registro

#### Filtros y Búsqueda
- 🔍 **Buscar** por código o nombre
- 📅 **Filtrar** por fechas
- 🏗️ **Filtrar** por proyecto
- 📊 **Filtrar** por estado

#### Paginación
- Navegación entre páginas
- Selección de registros por página
- Total de registros mostrado

### Acciones Disponibles

#### Ver Detalle
1. Click en el **icono de ojo** 👁️
2. Se abre modal con información completa
3. Incluye historial de cambios

#### Editar Registro (Solo Administradores)
1. Click en el **icono de editar** ✏️
2. Formulario pre-llenado con datos actuales
3. Modificar campos necesarios
4. Guardar cambios

#### Exportar Datos
1. Click en **"Exportar"**
2. Seleccionar formato (PDF, Excel)
3. Descarga automática del archivo

---

## 📊 Reportes y Estadísticas

### Reporte de Piezas Pendientes

![Pending Pieces Report](./images/pending-pieces-report.png)

#### Acceso
- Desde menú: **Reportes → Piezas Pendientes**

#### Información Mostrada
- Lista de todas las piezas no fabricadas
- Agrupación por proyecto
- Detalles de peso teórico
- Información de bloque y código

#### Filtros Disponibles
- **Por Proyecto**: Ver solo un proyecto específico
- **Por Bloque**: Filtrar por sección
- **Por Material**: Filtrar por tipo de material

### Dashboard con Gráficos

![Dashboard Charts](./images/dashboard-charts.png)

#### Gráfico de Barras
- **Pendientes vs Fabricadas** por proyecto
- Actualización en tiempo real
- Colores diferenciados por estado

#### Métricas Principales
- 📊 **Total de Proyectos** activos
- 🔧 **Total de Piezas** en el sistema  
- ⏳ **Piezas Pendientes** de fabricar
- ✅ **Piezas Fabricadas** completadas
- 📈 **Porcentaje de Progreso** general

#### Indicadores de Tendencia
- 📈 **Piezas fabricadas hoy**
- 📊 **Promedio semanal** de fabricación
- ⚠️ **Alertas** de piezas con diferencias significativas

---

## 🔧 Funciones Avanzadas

### Gestión de Perfil

![Profile Management](./images/profile-management.png)

#### Acceso
1. Click en **tu nombre** (esquina superior derecha)
2. Seleccionar **"Perfil"**

#### Funciones Disponibles
- ✏️ **Editar información personal**
- 🔒 **Cambiar contraseña**
- 🔐 **Configurar autenticación 2FA** (opcional)
- 📱 **Gestionar sesiones activas**

### Configuración de Notificaciones

#### Tipos de Notificaciones
- ✅ **Registro exitoso** de pieza
- ⚠️ **Diferencias significativas** de peso
- 📧 **Resumen diario** por email
- 🔔 **Alertas del sistema**

### Búsqueda Avanzada

![Advanced Search](./images/advanced-search.png)

#### Criterios de Búsqueda
- 🏗️ **Por Proyecto**: Nombre o código
- 🧱 **Por Bloque**: Sección específica
- ⚙️ **Por Pieza**: Código o nombre
- 📅 **Por Fecha**: Rango de fechas
- 👤 **Por Usuario**: Quién registró
- 📊 **Por Estado**: Pendiente/Fabricado
- ⚖️ **Por Peso**: Rangos de peso

#### Operadores de Búsqueda
- `=` **Igual a**
- `>` **Mayor que**
- `<` **Menor que**
- `~` **Contiene**
- `!` **No igual a**

---

## 📱 Uso en Dispositivos Móviles

### Diseño Responsive

El sistema está optimizado para usar en:
- 📱 **Smartphones** (iOS/Android)
- 📱 **Tablets** 
- 💻 **Laptops**
- 🖥️ **Monitores de escritorio**

![Mobile Interface](./images/mobile-interface.png)

### Funcionalidades Móviles

#### Navegación Touch
- ✅ **Menú hamburguesa** en pantallas pequeñas
- ✅ **Gestos táctiles** para navegación
- ✅ **Botones optimizados** para dedos

#### Formularios Móviles
- ✅ **Teclado numérico** para peso real
- ✅ **Selects táctiles** optimizados
- ✅ **Validación en tiempo real**

#### Tablas Responsivas
- ✅ **Scroll horizontal** para tablas amplias
- ✅ **Cards colapsables** en móviles
- ✅ **Información esencial** siempre visible

---

## ⚠️ Validaciones y Errores

### Validaciones del Sistema

![Validation Examples](./images/validation-examples.png)

#### Campos Obligatorios
- ❌ **Proyecto**: Debe seleccionarse
- ❌ **Bloque**: Debe seleccionarse  
- ❌ **Pieza**: Debe seleccionarse
- ❌ **Peso Real**: Debe ser un número válido

#### Validaciones de Formato
- 🔢 **Peso Real**: Solo números decimales positivos
- 📧 **Email**: Formato válido requerido
- 🔒 **Contraseña**: Mínimo 8 caracteres

### Mensajes de Error Comunes

#### Errores de Validación
```
❌ "El campo peso real es obligatorio"
❌ "El peso real debe ser un número"
❌ "Debe seleccionar un proyecto"
❌ "Debe seleccionar una pieza"
```

#### Errores de Sistema
```
⚠️ "Error de conexión - verificar internet"
⚠️ "Sesión expirada - volver a iniciar sesión"
⚠️ "No tiene permisos para esta acción"
```

### Cómo Resolver Errores

1. **Leer el mensaje** de error cuidadosamente
2. **Verificar los campos** resaltados en rojo
3. **Corregir los datos** según las indicaciones
4. **Intentar nuevamente** el envío
5. Si persiste, **contactar soporte técnico**

---

## 🚨 Casos de Uso Especiales

### Piezas con Diferencias Significativas

![Weight Differences](./images/weight-differences.png)

#### Cuándo Ocurre
- Diferencia de peso > 5% del peso teórico
- Material diferente al especificado
- Modificaciones durante fabricación

#### Procedimiento
1. **Verificar medición** del peso real
2. **Documentar observaciones** detalladas
3. **Registrar normalmente** en el sistema
4. **Notificar al supervisor** si es necesario
5. El sistema **marcará automáticamente** la diferencia

### Corrección de Errores

#### Errores de Digitación
1. **Identificar** el registro incorrecto
2. **Acceder** al modo edición (solo admins)
3. **Corregir** los datos erróneos
4. **Guardar** cambios con observación
5. El sistema **mantiene historial** de cambios

### Piezas Canceladas o Rechazadas

#### Proceso
1. **Cambiar estado** a "Otro"
2. **Documentar motivo** en observaciones
3. **Notificar** al equipo correspondiente
4. La pieza **no contará** en estadísticas de fabricadas

---

## 🔒 Seguridad y Buenas Prácticas

### Protección de Datos

![Security Practices](./images/security-practices.png)

#### Mejores Prácticas
- 🔐 **Cerrar sesión** al terminar
- 🔒 **No compartir contraseñas**
- 👀 **Verificar datos** antes de guardar
- 📱 **Usar dispositivos seguros**
- 🔄 **Cambiar contraseña** periódicamente

#### Políticas de Sesión
- ⏰ **Auto-logout** después de 2 horas inactivo
- 🔐 **Sesión única** por usuario
- 📱 **Gestión de dispositivos** registrados

### Auditoría de Acciones

#### El sistema registra:
- 👤 **Quién** realizó cada acción
- 📅 **Cuándo** se ejecutó
- 🎯 **Qué** se modificó
- 🌐 **Desde dónde** (IP del dispositivo)

---

## 📞 Soporte y Ayuda

### Contactos de Soporte

| Tipo de Consulta | Contacto | Horario |
|------------------|----------|---------|
| **Soporte Técnico** | soporte@cotecmar.com | Lun-Vie 8am-6pm |
| **Dudas de Proceso** | procesos@cotecmar.com | Lun-Vie 7am-5pm |
| **Emergencias** | +57 123 456 7890 | 24/7 |

### Recursos de Autoayuda

- 📚 **Manual completo**: Disponible en el sistema
- ❓ **FAQ**: Preguntas frecuentes en ayuda
- 🎥 **Videos tutoriales**: En el portal interno
- 📋 **Guías rápidas**: Descargables en PDF

### Reportar Problemas

#### Información a Incluir
1. **Descripción** detallada del problema
2. **Pasos** que llevaron al error
3. **Captura de pantalla** si es posible
4. **Navegador y versión** utilizada
5. **Hora exacta** del incidente

#### Canales de Reporte
- 📧 **Email**: bugs@cotecmar.com
- 📞 **Teléfono**: Línea de soporte
- 💬 **Chat interno**: Disponible en el sistema

---

## 📚 Glosario de Términos

| Término | Definición |
|---------|------------|
| **Minucia** | Control detallado y preciso de medidas y especificaciones |
| **Peso Teórico** | Peso calculado según diseño y especificaciones técnicas |
| **Peso Real** | Peso medido físicamente de la pieza fabricada |
| **Diferencia de Peso** | Variación entre peso real y teórico (real - teórico) |
| **Estado Pendiente** | Pieza que aún no ha sido fabricada |
| **Estado Fabricado** | Pieza completada y registrada en el sistema |
| **Bloque** | Sección o módulo de un proyecto naval |
| **Proyecto** | Programa completo de construcción naval |

---

## 🔄 Actualizaciones del Manual

**Versión 1.0** - Octubre 2024
- Manual inicial completo
- Todas las funcionalidades básicas
- Casos de uso principales

**Próximas Versiones**:
- Funcionalidades de exportación avanzada
- Integración con sistemas externos
- Módulo de planificación de fabricación

---

## ← Volver

← [README Principal](../README.md)  
← [Manual de Instalación](./INSTALL.md)

---

<div align="center">
  <strong>👥 Manual de Usuario - Sistema COTECMAR 👥</strong>
  <br>
  <em>Para dudas adicionales, contactar al equipo de soporte técnico</em>
</div>
