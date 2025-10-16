<template>
    <AppLayout title="Dashboard - Minucia">
        <template #header>
            <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Dashboard - Sistema de Minucia
                    </h2>
                    <p class="text-blue-200 mt-2">Control y seguimiento de piezas navales</p>
                </div>
            </div>
        </template>

        <div class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Tarjetas de estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-xl sm:rounded-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Total Proyectos</p>
                                <p class="text-3xl font-bold text-slate-800">{{ estadisticas.total_proyectos }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm border border-emerald-200 overflow-hidden shadow-xl sm:rounded-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Total Piezas</p>
                                <p class="text-3xl font-bold text-slate-800">{{ estadisticas.total_piezas }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm border border-amber-200 overflow-hidden shadow-xl sm:rounded-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11a1 1 0 001 1h3v-8h6v8h3a1 1 0 001-1V7l-7-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Piezas Pendientes</p>
                                <p class="text-3xl font-bold text-slate-800">{{ estadisticas.piezas_pendientes }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm border border-purple-200 overflow-hidden shadow-xl sm:rounded-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-slate-600">Registros Hoy</p>
                                <p class="text-3xl font-bold text-slate-800">{{ estadisticas.registros_hoy }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <Link :href="route('minucia.create')"
                          class="group bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-xl sm:rounded-xl p-8 hover:bg-blue-50 hover:border-blue-300 transition-all duration-300 cursor-pointer hover:scale-105 hover:shadow-2xl">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-blue-600 group-hover:text-blue-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-800 transition-colors duration-300">Nuevo Registro</h3>
                            <p class="text-sm text-slate-600 group-hover:text-blue-700 transition-colors duration-300">Registrar nueva pieza en la minucia</p>
                        </div>
                    </Link>

                    <Link :href="route('minucia.listado')"
                          class="group bg-white/80 backdrop-blur-sm border border-emerald-200 overflow-hidden shadow-xl sm:rounded-xl p-8 hover:bg-emerald-50 hover:border-emerald-300 transition-all duration-300 cursor-pointer hover:scale-105 hover:shadow-2xl">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-emerald-200 group-hover:to-emerald-300 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-emerald-600 group-hover:text-emerald-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-emerald-800 transition-colors duration-300">Ver Registros</h3>
                            <p class="text-sm text-slate-600 group-hover:text-emerald-700 transition-colors duration-300">Consultar registros de minucia</p>
                        </div>
                    </Link>

                    <Link :href="route('reportes.piezas-pendientes')"
                          class="group bg-white/80 backdrop-blur-sm border border-purple-200 overflow-hidden shadow-xl sm:rounded-xl p-8 hover:bg-purple-50 hover:border-purple-300 transition-all duration-300 cursor-pointer hover:scale-105 hover:shadow-2xl">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-purple-200 group-hover:to-purple-300 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8 text-purple-600 group-hover:text-purple-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-purple-800 transition-colors duration-300">Reportes</h3>
                            <p class="text-sm text-slate-600 group-hover:text-purple-700 transition-colors duration-300">Ver reportes y estadísticas</p>
                        </div>
                    </Link>
                </div>

                <!-- Lista de proyectos -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Proyectos Activos</h3>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Proyecto
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bloques
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Piezas Totales
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="proyecto in proyectos" :key="proyecto.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ proyecto.nombre }}</div>
                                                <div class="text-sm text-gray-500">{{ proyecto.descripcion }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ proyecto.codigo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ proyecto.bloques.length }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ proyecto.bloques.reduce((total, bloque) => total + bloque.piezas.length, 0) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="{
                                                'bg-green-100 text-green-800': proyecto.estado === 'activo',
                                                'bg-gray-100 text-gray-800': proyecto.estado === 'inactivo',
                                                'bg-blue-100 text-blue-800': proyecto.estado === 'completado'
                                            }" class="inline-flex px-2 py-1 text-xs font-semibold rounded-full">
                                                {{ proyecto.estado }}
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

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
    proyectos: Array,
    estadisticas: Object
})
</script>
