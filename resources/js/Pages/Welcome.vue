<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-blue-100 hover:text-white transition-colors duration-200 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-400">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl focus:outline focus:outline-2 focus:outline-blue-400">
                    Iniciar Sesión
                </Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <!-- Logo y título principal -->
            <div class="text-center mb-16">
                <div class="flex justify-center mb-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-2xl">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4">
                    Sistema de Gestión de Minucia
                </h1>
                <h2 class="text-2xl font-medium text-blue-200 mb-2">
                    Cotecmar - Control de Calidad Naval
                </h2>
                <p class="text-lg text-blue-100 mb-8">
                    Prueba Técnica de Cotecmar
                </p>
                <div class="inline-block px-4 py-2 bg-blue-800/30 rounded-full">
                    <span class="text-blue-200 font-medium">Desarrollado por: Aldair Gutiérrez</span>
                </div>
            </div>

            <!-- Características del sistema -->
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    <div class="group p-8 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="w-8 h-8 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-blue-200 transition-colors duration-300">
                                    Control de Calidad
                                </h3>
                                <p class="text-blue-100 leading-relaxed">
                                    Sistema completo para el registro y seguimiento de piezas navales, con control de peso teórico vs real y cálculo automático de diferencias.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group p-8 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="w-8 h-8 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-emerald-200 transition-colors duration-300">
                                    Reportes Avanzados
                                </h3>
                                <p class="text-blue-100 leading-relaxed">
                                    Generación de reportes detallados por proyecto, estadísticas en tiempo real y seguimiento del progreso de fabricación.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group p-8 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="w-8 h-8 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-purple-200 transition-colors duration-300">
                                    Diseño Responsive
                                </h3>
                                <p class="text-blue-100 leading-relaxed">
                                    Interfaz optimizada para dispositivos móviles, tablets y desktop. Acceso completo desde cualquier dispositivo.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group p-8 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="w-8 h-8 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-orange-200 transition-colors duration-300">
                                    Tecnología Moderna
                                </h3>
                                <p class="text-blue-100 leading-relaxed">
                                    Desarrollado con Laravel 10, Vue.js 3 e Inertia.js. Base de datos SQLite para máximo rendimiento y portabilidad.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                <div class="text-center text-sm sm:text-start">
                    &nbsp;
                </div>

                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
