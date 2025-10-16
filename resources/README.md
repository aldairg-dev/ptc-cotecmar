# 🎨 Estructura de Vistas y Frontend - Sistema COTECMAR

![Frontend Architecture](../docs/images/frontend-architecture.png)

## 📋 Descripción General

El frontend del Sistema COTECMAR está construido con **Vue.js 3** + **Inertia.js** + **Tailwind CSS**, siguiendo una arquitectura de componentes reutilizables y design system consistente.

## 🏗️ Arquitectura Frontend

```
Vue.js 3 (Composition API)
├── Inertia.js (SPA sin API separada)
├── Tailwind CSS (Styling framework)
├── Chart.js (Gráficos interactivos)
└── Axios (HTTP requests)
```

## 📁 Estructura de Carpetas

```
resources/
├── css/
│   └── app.css ........................ Estilos base y Tailwind
├── js/
│   ├── app.js ......................... Configuración principal de Vue
│   ├── bootstrap.js ................... Configuración de Axios y CSRF
│   ├── Components/ .................... Componentes reutilizables
│   │   ├── ApplicationLogo.vue ........ Logo de la aplicación
│   │   ├── Checkbox.vue ............... Componente checkbox
│   │   ├── DangerButton.vue ........... Botón de acción peligrosa
│   │   ├── InputLabel.vue ............. Etiquetas de inputs
│   │   ├── PrimaryButton.vue .......... Botón principal
│   │   ├── SecondaryButton.vue ........ Botón secundario
│   │   └── TextInput.vue .............. Input de texto
│   ├── Layouts/ ....................... Layouts base
│   │   ├── AppLayout.vue .............. Layout principal con navegación
│   │   ├── AuthenticationCardLogo.vue . Logo para autenticación
│   │   └── GuestLayout.vue ............ Layout para visitantes
│   └── Pages/ ......................... Páginas principales
│       ├── Auth/ ...................... Páginas de autenticación
│       ├── Minucia/ ................... Módulo principal del sistema
│       ├── Profile/ ................... Gestión de perfil
│       └── Reportes/ .................. Módulo de reportes
├── markdown/ .......................... Archivos markdown (políticas)
└── views/ ............................. Plantillas Blade
    └── app.blade.php .................. Plantilla base
```

![Folder Structure](../docs/images/folder-structure.png)

---

## 🧩 Componentes Base (Components/)

### 🎨 Componentes de UI

#### ApplicationLogo.vue
```vue
<!-- Logo principal de COTECMAR -->
<template>
    <div class="flex items-center">
        <img src="/images/cotecmar-logo.png" 
             alt="COTECMAR" 
             class="h-8 w-auto" />
    </div>
</template>
```

#### PrimaryButton.vue
```vue
<!-- Botón principal con estilos consistentes -->
<template>
    <button
        type="button"
        class="px-4 py-2 bg-blue-600 border border-transparent 
               rounded-md font-semibold text-xs text-white uppercase 
               tracking-widest hover:bg-blue-700 focus:bg-blue-700 
               active:bg-blue-900 transition ease-in-out duration-150"
        :class="{ 'opacity-50 cursor-not-allowed': disabled }"
        :disabled="disabled"
    >
        <slot />
    </button>
</template>
```

#### TextInput.vue
```vue
<!-- Input de texto con validaciones y estilos -->
<template>
    <input
        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 
               rounded-md shadow-sm"
        :class="{ 'border-red-500': hasError }"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
```

![UI Components](../docs/images/ui-components.png)

---

## 🏠 Layouts (Layouts/)

### AppLayout.vue - Layout Principal

**Estructura**:
```vue
<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <!-- Logo y menú principal -->
        </nav>

        <!-- Page Heading -->
        <header v-if="$slots.header" class="bg-white shadow">
            <slot name="header" />
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>
```

**Características**:
- ✅ Navegación responsive
- ✅ Menú de usuario con dropdown
- ✅ Indicador de página activa
- ✅ Notificaciones toast
- ✅ Logout automático

![App Layout](../docs/images/app-layout.png)

### Navegación Principal

```vue
<!-- Menú principal en AppLayout.vue -->
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('minucia.create')" :active="route().current('minucia.*')">
        Nuevo Registro
    </NavLink>
    <NavLink :href="route('minucia.registros')" :active="route().current('minucia.registros')">
        Ver Registros
    </NavLink>
    <NavLink :href="route('reportes.piezas-pendientes')" :active="route().current('reportes.*')">
        Reportes
    </NavLink>
</div>
```

---

## 📄 Páginas Principales (Pages/)

### 🔐 Autenticación (Pages/Auth/)

```
Auth/
├── ConfirmPassword.vue ................ Confirmación de contraseña
├── ForgotPassword.vue ................. Recuperar contraseña
├── Login.vue .......................... Página de login principal
├── Register.vue ....................... Registro de usuarios
├── ResetPassword.vue .................. Resetear contraseña
├── TwoFactorChallenge.vue ............. Autenticación 2FA
└── VerifyEmail.vue .................... Verificación de email
```

#### Login.vue - Página Principal de Acceso
```vue
<template>
    <GuestLayout>
        <Head title="Iniciar Sesión" />

        <AuthenticationCard>
            <template #logo>
                <AuthenticationCardLogo />
            </template>

            <div class="mb-4 text-sm text-gray-600">
                Sistema de Gestión de Minucia - COTECMAR
            </div>

            <form @submit.prevent="submit">
                <!-- Email input -->
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Password input -->
                <div class="mt-4">
                    <InputLabel for="password" value="Contraseña" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Remember me -->
                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900"
                    >
                        ¿Olvidaste tu contraseña?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Iniciar Sesión
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>
    </GuestLayout>
</template>
```

![Login Page](../docs/images/login-page.png)

---

### 🏠 Dashboard (Pages/Dashboard.vue)

**Funcionalidades**:
- 📊 Estadísticas en tiempo real
- 📈 Gráficos de progreso por proyecto
- 🔗 Enlaces rápidos a funciones principales
- 📱 Design responsive

```vue
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard - Sistema de Gestión de Minucia
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 truncate">
                                        Total Proyectos
                                    </p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ estadisticas.total_proyectos }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Más cards... -->
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Gráfico de barras -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Progreso por Proyecto</h3>
                            <canvas id="proyectosChart"></canvas>
                        </div>
                    </div>

                    <!-- Lista de piezas pendientes -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Piezas Pendientes</h3>
                            <div class="space-y-3">
                                <div v-for="pieza in piezasPendientes.slice(0, 5)" :key="pieza.id" 
                                     class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                    <div>
                                        <p class="font-medium">{{ pieza.codigo }}</p>
                                        <p class="text-sm text-gray-600">{{ pieza.proyecto_nombre }}</p>
                                    </div>
                                    <span class="text-sm text-orange-600 font-medium">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
```

![Dashboard](../docs/images/dashboard-page.png)

---

### 📝 Módulo Minucia (Pages/Minucia/)

```
Minucia/
├── Dashboard.vue ...................... Dashboard específico del módulo
├── FormularioRegistro.vue ............. Formulario principal ⭐
└── ListadoRegistros.vue ............... Lista de registros históricos
```

#### FormularioRegistro.vue - Componente Principal ⭐

**Características**:
- ✅ Selects dependientes (Proyecto → Bloque → Pieza)
- ✅ Carga automática de peso teórico
- ✅ Cálculo en tiempo real de diferencia de peso
- ✅ Validaciones en cliente
- ✅ Manejo de estados de carga
- ✅ Design responsive

```vue
<template>
    <AppLayout title="Registro de Minucia">
        <template #header>
            <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Registro de Minucia
                    </h2>
                    <p class="text-blue-200 mt-2">Registrar nueva pieza en el sistema</p>
                </div>
            </div>
        </template>

        <div class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-2xl sm:rounded-2xl">
                    <div class="p-8">
                        <form @submit.prevent="submitForm" class="space-y-8">
                            <!-- Fecha y Usuario -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        Fecha y Hora de Registro
                                    </label>
                                    <input
                                        type="text"
                                        :value="currentDateTime"
                                        readonly
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 text-slate-600 font-medium shadow-inner"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        Usuario
                                    </label>
                                    <input
                                        type="text"
                                        :value="$page.props.auth.user.name"
                                        readonly
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 text-slate-600 font-medium shadow-inner"
                                    />
                                </div>
                            </div>

                            <!-- Selección de Proyecto -->
                            <div>
                                <label for="proyecto_id" class="block text-sm font-bold text-slate-700 mb-3">
                                    Proyecto *
                                </label>
                                <select
                                    id="proyecto_id"
                                    v-model="form.proyecto_id"
                                    @change="onProyectoChange"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300"
                                    :class="{ 'border-red-400 focus:ring-red-500 focus:border-red-500': errors.proyecto_id }"
                                >
                                    <option value="">Seleccione un proyecto</option>
                                    <option v-for="proyecto in proyectos" :key="proyecto.id" :value="proyecto.id">
                                        {{ proyecto.codigo }} - {{ proyecto.nombre }}
                                    </option>
                                </select>
                                <p v-if="errors.proyecto_id" class="mt-2 text-sm text-red-600">
                                    {{ errors.proyecto_id }}
                                </p>
                            </div>

                            <!-- Selección de Bloque -->
                            <div>
                                <label for="bloque_id" class="block text-sm font-bold text-slate-700 mb-3">
                                    Bloque *
                                </label>
                                <select
                                    id="bloque_id"
                                    v-model="form.bloque_id"
                                    @change="onBloqueChange"
                                    :disabled="!bloques.length"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300 disabled:bg-gray-100 disabled:cursor-not-allowed"
                                >
                                    <option value="">
                                        {{ bloques.length ? 'Seleccione un bloque' : 'Primero seleccione un proyecto' }}
                                    </option>
                                    <option v-for="bloque in bloques" :key="bloque.id" :value="bloque.id">
                                        {{ bloque.codigo }} - {{ bloque.nombre }}
                                    </option>
                                </select>
                            </div>

                            <!-- Selección de Pieza -->
                            <div>
                                <label for="pieza_id" class="block text-sm font-bold text-slate-700 mb-3">
                                    Pieza *
                                </label>
                                <select
                                    id="pieza_id"
                                    v-model="form.pieza_id"
                                    @change="onPiezaChange"
                                    :disabled="!piezas.length"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300 disabled:bg-gray-100 disabled:cursor-not-allowed"
                                >
                                    <option value="">
                                        {{ piezas.length ? 'Seleccione una pieza' : 'Primero seleccione un bloque' }}
                                    </option>
                                    <option v-for="pieza in piezas" :key="pieza.id" :value="pieza.id">
                                        {{ pieza.codigo }} - {{ pieza.nombre }} ({{ pieza.peso_teorico }} kg)
                                    </option>
                                </select>
                            </div>

                            <!-- Peso Teórico (readonly) -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-3">
                                    Peso Teórico (kg)
                                </label>
                                <input
                                    type="text"
                                    :value="piezaSeleccionada ? piezaSeleccionada.peso_teorico : ''"
                                    readonly
                                    placeholder="Seleccione una pieza"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 text-slate-600 font-medium shadow-inner"
                                />
                            </div>

                            <!-- Peso Real -->
                            <div>
                                <label for="peso_real" class="block text-sm font-bold text-slate-700 mb-3">
                                    Peso Real (kg) *
                                </label>
                                <input
                                    id="peso_real"
                                    type="number"
                                    step="0.001"
                                    min="0"
                                    v-model="form.peso_real"
                                    @input="calculateDifference"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200 hover:border-blue-300"
                                    placeholder="Ingrese el peso real medido"
                                />
                            </div>

                            <!-- Diferencia de Peso -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-3">
                                    Diferencia de Peso (kg)
                                </label>
                                <input
                                    type="text"
                                    :value="diferenciaPeso"
                                    readonly
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 font-medium shadow-inner"
                                    :class="{
                                        'text-green-600': diferenciaPeso > 0,
                                        'text-red-600': diferenciaPeso < 0,
                                        'text-slate-600': diferenciaPeso === 0,
                                    }"
                                />
                            </div>

                            <!-- Observaciones -->
                            <div>
                                <label for="observaciones" class="block text-sm font-bold text-slate-700 mb-3">
                                    Observaciones
                                </label>
                                <textarea
                                    id="observaciones"
                                    v-model="form.observaciones"
                                    rows="4"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200 hover:border-blue-300 resize-none"
                                    placeholder="Observaciones adicionales sobre la pieza (opcional)"
                                ></textarea>
                            </div>

                            <!-- Botones -->
                            <div class="flex justify-end space-x-4 pt-6">
                                <Link
                                    :href="route('minucia.index')"
                                    class="px-6 py-3 border border-slate-300 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md"
                                >
                                    Cancelar
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-xl text-sm font-bold text-white hover:from-blue-700 hover:to-blue-800 disabled:opacity-50 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    <span v-if="processing">
                                        <svg class="w-4 h-4 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Guardando...
                                    </span>
                                    <span v-else>
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Guardar Registro
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

// Lógica del componente...
</script>
```

![Registration Form](../docs/images/registration-form-detail.png)

---

### 📊 Módulo Reportes (Pages/Reportes/)

```
Reportes/
└── PiezasPendientes.vue ............... Reporte de piezas pendientes
```

#### PiezasPendientes.vue
```vue
<template>
    <AppLayout title="Piezas Pendientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reporte de Piezas Pendientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Filtros -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Proyecto</label>
                                <select v-model="filtroProyecto" @change="filtrarDatos" 
                                        class="mt-1 block w-full border-gray-300 rounded-md">
                                    <option value="">Todos los proyectos</option>
                                    <option v-for="proyecto in proyectos" :key="proyecto.id" :value="proyecto.id">
                                        {{ proyecto.nombre }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de piezas pendientes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Proyecto
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bloque
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pieza
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Peso Teórico (kg)
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="pieza in piezasFiltradas" :key="pieza.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ pieza.proyecto.nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ pieza.bloque.nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ pieza.codigo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ pieza.nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ pieza.peso_teorico }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ pieza.estado }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
```

![Reports Page](../docs/images/reports-page.png)

---

## 🎨 Estilos y Diseño (CSS/)

### app.css - Configuración de Tailwind

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Estilos personalizados para COTECMAR */
@layer base {
    html {
        font-family: 'Inter', system-ui, sans-serif;
    }
}

@layer components {
    /* Botones personalizados */
    .btn-primary {
        @apply px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 
               focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
               transition-all duration-200;
    }

    .btn-secondary {
        @apply px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 
               focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 
               transition-all duration-200;
    }

    /* Inputs personalizados */
    .input-primary {
        @apply w-full px-3 py-2 border border-gray-300 rounded-lg 
               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
               transition-all duration-200;
    }

    /* Cards */
    .card {
        @apply bg-white rounded-lg shadow-md border border-gray-200;
    }

    .card-header {
        @apply px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg;
    }

    .card-body {
        @apply px-6 py-4;
    }

    /* Estados */
    .status-pending {
        @apply inline-flex px-2 py-1 text-xs font-semibold rounded-full 
               bg-yellow-100 text-yellow-800;
    }

    .status-completed {
        @apply inline-flex px-2 py-1 text-xs font-semibold rounded-full 
               bg-green-100 text-green-800;
    }

    .status-error {
        @apply inline-flex px-2 py-1 text-xs font-semibold rounded-full 
               bg-red-100 text-red-800;
    }

    /* Gradientes para headers */
    .gradient-header {
        @apply bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900;
    }

    .gradient-background {
        @apply bg-gradient-to-br from-slate-50 to-blue-50;
    }
}

/* Animaciones personalizadas */
@layer utilities {
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    .animate-slide-up {
        animation: slideUp 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0; 
            transform: translateY(10px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
}

/* Estilos para gráficos Chart.js */
.chart-container {
    position: relative;
    height: 400px;
    width: 100%;
}

/* Responsive breakpoints personalizados */
@media (max-width: 640px) {
    .mobile-stack {
        @apply flex-col space-y-4 space-x-0;
    }
}

/* Estilos para dark mode (futuro) */
@media (prefers-color-scheme: dark) {
    .dark-mode {
        @apply bg-gray-900 text-white;
    }
}
```

---

## ⚡ JavaScript Principal (JS/)

### app.js - Configuración de Vue

```javascript
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Sistema COTECMAR';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4F46E5', // Color azul de COTECMAR
        showSpinner: true,
    },
});
```

### bootstrap.js - Configuración HTTP

```javascript
import axios from 'axios';
window.axios = axios;

// Configuración de headers por defecto
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Configurar token CSRF para todas las peticiones
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Interceptor para manejo global de errores
window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            window.location.href = '/login';
        }
        if (error.response.status === 419) {
            // Token CSRF expirado
            window.location.reload();
        }
        return Promise.reject(error);
    }
);
```

---

## 📱 Responsive Design

### Breakpoints de Tailwind CSS

```javascript
// tailwind.config.js
module.exports = {
    theme: {
        screens: {
            'sm': '640px',   // Móviles grandes
            'md': '768px',   // Tablets
            'lg': '1024px',  // Laptops
            'xl': '1280px',  // Escritorio
            '2xl': '1536px', // Pantallas grandes
        }
    }
}
```

### Estrategias Responsive

1. **Mobile First**: Diseño base para móviles, escalando hacia arriba
2. **Grid Responsive**: `grid-cols-1 md:grid-cols-2 lg:grid-cols-3`
3. **Navigation**: Menú hamburguesa en móviles, horizontal en escritorio
4. **Tables**: Scroll horizontal en móviles, tabla completa en escritorio
5. **Forms**: Stack vertical en móviles, grid en escritorio

![Responsive Design](../docs/images/responsive-design.png)

---

## 🔧 Herramientas de Desarrollo

### Vite Configuration (vite.config.js)

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
```

### Comandos de Desarrollo

```bash
# Desarrollo con hot reload
npm run dev

# Build para producción
npm run build

# Watch mode
npm run watch

# Verificar sintaxis Vue
npm run lint

# Verificar tipos TypeScript (si aplica)
npm run type-check
```

---

## 🎯 Mejores Prácticas Implementadas

### 1. **Composición de Componentes**
- ✅ Componentes reutilizables y modulares
- ✅ Props tipadas con PropTypes
- ✅ Eventos customizados para comunicación
- ✅ Slots para contenido dinámico

### 2. **Estado y Reactividad**
- ✅ Composition API con `ref()` y `reactive()`
- ✅ Computed properties para datos derivados
- ✅ Watchers para efectos secundarios
- ✅ Store pattern para estado global

### 3. **Performance**
- ✅ Lazy loading de páginas con `import()`
- ✅ Code splitting automático por rutas
- ✅ Optimización de imágenes
- ✅ Minificación en producción

### 4. **Accesibilidad**
- ✅ Labels asociados a inputs
- ✅ ARIA attributes donde es necesario
- ✅ Navegación por teclado
- ✅ Contraste adecuado de colores

### 5. **SEO**
- ✅ Meta tags dinámicos con Inertia Head
- ✅ Títulos descriptivos por página
- ✅ URLs semánticas
- ✅ Estructura HTML semántica

---

## 🐛 Debugging y Herramientas

### Vue DevTools
```bash
# Instalar Vue DevTools en el navegador
# https://devtools.vuejs.org/
```

### Laravel Debugbar (Desarrollo)
```bash
composer require barryvdh/laravel-debugbar --dev
```

### Console Debugging
```javascript
// En componentes Vue
console.log('Current user:', this.$page.props.auth.user);
console.log('Form data:', this.form.data());
console.log('Errors:', this.form.errors);

// En métodos
methods: {
    debugFormSubmit() {
        console.group('Form Submit Debug');
        console.log('Form valid:', this.form.isDirty);
        console.log('Processing:', this.form.processing);
        console.log('Data:', this.form.data());
        console.groupEnd();
    }
}
```

---

## 📈 Métricas de Performance

### Core Web Vitals
- **LCP** (Largest Contentful Paint): < 2.5s
- **FID** (First Input Delay): < 100ms  
- **CLS** (Cumulative Layout Shift): < 0.1

### Bundle Size Analysis
```bash
# Analizar tamaño del bundle
npm run build -- --analyze

# Verificar dependencias
npm list --depth=0
```

---

## 🔄 Patrones de Estado

### Form Management con Inertia
```javascript
// En un componente
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    proyecto_id: '',
    bloque_id: '',
    pieza_id: '',
    peso_real: '',
    observaciones: ''
});

// Métodos del form
form.post(route('minucia.store'), {
    onSuccess: () => {
        // Éxito
        form.reset();
    },
    onError: (errors) => {
        // Manejo de errores
        console.error('Form errors:', errors);
    }
});
```

### Carga de Datos Asíncrona
```javascript
// Cargar datos dinámicamente
const cargarBloques = async (proyectoId) => {
    try {
        const response = await axios.get(`/api/bloques/proyecto/${proyectoId}`);
        bloques.value = response.data;
    } catch (error) {
        console.error('Error cargando bloques:', error);
        bloques.value = [];
    }
};
```

---

## 🔙 Volver al README Principal

← [README Principal](../README.md)  
← [Base de Datos](../database/README.md)

---

<div align="center">
  <strong>🎨 Frontend - Sistema COTECMAR 🎨</strong>
</div>
