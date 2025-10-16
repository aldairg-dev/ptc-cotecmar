<template>
    <AppLayout title="Registros de Minucia">
        <template #header>
            <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Registros de Minucia
                    </h2>
                    <p class="text-blue-200 mt-2">Historial completo de registros del sistema</p>
                </div>
            </div>
        </template>

        <div class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-2xl sm:rounded-2xl">
                    <div class="p-6 border-b border-blue-200 bg-gradient-to-r from-blue-50 to-slate-50">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Historial de Registros</h3>
                                <p class="text-sm text-slate-600 mt-1">Total: {{ registros.total }} registros</p>
                            </div>
                            <Link :href="route('minucia.create')"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Nuevo Registro
                            </Link>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-blue-200">
                            <thead class="bg-gradient-to-r from-slate-100 to-blue-100">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Fecha/Hora
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Proyecto
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Bloque
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        Pieza
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        Pesos (kg)
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Usuario
                                    </th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/60 backdrop-blur-sm divide-y divide-blue-100">
                                <tr v-for="registro in registros.data" :key="registro.id"
                                    class="hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                                        {{ formatDate(registro.fecha_registro) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-bold text-slate-800">{{ registro.proyecto.codigo }}
                                            </div>
                                            <div class="text-sm text-slate-600 truncate max-w-32">{{
                                                registro.proyecto.nombre }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-bold text-slate-800">{{ registro.bloque.codigo }}
                                            </div>
                                            <div class="text-sm text-slate-600 truncate max-w-32">{{
                                                registro.bloque.nombre }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-bold text-slate-800">{{ registro.pieza.codigo }}
                                            </div>
                                            <div class="text-sm text-slate-600 truncate max-w-32">{{
                                                registro.pieza.nombre }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="space-y-1">
                                            <div class="text-sm">
                                                <span class="text-slate-600">Teórico:</span>
                                                <span class="font-medium text-slate-800 ml-1">{{
                                                    parseFloat(registro.pieza.peso_teorico).toFixed(3) }}</span>
                                            </div>
                                            <div class="text-sm">
                                                <span class="text-slate-600">Real:</span>
                                                <span class="font-medium text-slate-800 ml-1">{{
                                                    parseFloat(registro.peso_real).toFixed(3) }}</span>
                                            </div>
                                            <div class="text-sm">
                                                <span class="text-slate-600">Diff:</span>
                                                <span :class="{
                                                    'text-emerald-600 font-bold': parseFloat(registro.diferencia_peso) >= 0,
                                                    'text-red-600 font-bold': parseFloat(registro.diferencia_peso) < 0
                                                }" class="ml-1">
                                                    {{ parseFloat(registro.diferencia_peso) >= 0 ? '+' : '' }}{{
                                                    parseFloat(registro.diferencia_peso).toFixed(3) }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-xs font-bold">{{
                                                    registro.user.name.charAt(0).toUpperCase() }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-800">{{ registro.user.name }}
                                                </div>
                                                <div class="text-xs text-slate-500">{{ registro.user.email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <Link :href="route('minucia.ver', registro.id)"
                                                class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-100 transition-all duration-200"
                                                title="Ver detalles">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            </Link>
                                            <Link :href="route('minucia.editar', registro.id)"
                                                class="text-emerald-600 hover:text-emerald-800 p-2 rounded-lg hover:bg-emerald-100 transition-all duration-200"
                                                title="Editar registro">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            </Link>
                                            <button @click="confirmDelete(registro)"
                                                class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-100 transition-all duration-200"
                                                title="Eliminar registro">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div v-if="registros.links" class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <Link v-if="registros.prev_page_url" :href="registros.prev_page_url"
                                    class="relative inline-flex items-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 transition-all duration-200">
                                Anterior
                                </Link>
                                <Link v-if="registros.next_page_url" :href="registros.next_page_url"
                                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-xl text-blue-700 bg-white hover:bg-blue-50 transition-all duration-200">
                                Siguiente
                                </Link>
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-slate-700">
                                        Mostrando <span class="font-bold text-blue-700">{{ registros.from }}</span> a <span
                                            class="font-bold text-blue-700">{{ registros.to }}</span> de <span class="font-bold text-blue-700">{{
                                            registros.total }}</span> resultados
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-xl shadow-sm -space-x-px">
                                        <template v-for="link in registros.links" :key="link.label">
                                            <Link v-if="link.url" :href="link.url" v-html="link.label"
                                                class="relative inline-flex items-center px-3 py-2 border text-sm font-medium transition-all duration-200"
                                                :class="link.active
                                                    ? 'z-10 bg-blue-600 border-blue-600 text-white'
                                                    : 'bg-white border-blue-300 text-blue-700 hover:bg-blue-50'">
                                            </Link>
                                            <span v-else v-html="link.label"
                                                class="relative inline-flex items-center px-3 py-2 border border-blue-300 bg-blue-100 text-sm font-medium text-blue-400">
                                            </span>
                                        </template>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Mensaje si no hay registros -->
                <div v-if="registros.data.length === 0" class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay registros</h3>
                    <p class="text-gray-500">Aún no se han registrado piezas en la minucia.</p>
                    <Link :href="route('minucia.create')"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Crear Primer Registro
                    </Link>
                </div>
            </div>
        </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    registros: Object
})

const formatDate = (dateString) => {
    return new Intl.DateTimeFormat('es-CO', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    }).format(new Date(dateString))
}

const confirmDelete = (registro) => {
    if (confirm(`¿Está seguro de eliminar el registro de la pieza "${registro.pieza.codigo}"?\n\nEsta acción no se puede deshacer y la pieza volverá a estado "pendiente".`)) {
        router.delete(route('minucia.destroy', registro.id))
    }
}
</script>
