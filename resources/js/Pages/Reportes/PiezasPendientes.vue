<template>
    <AppLayout title="Reporte - Piezas Pendientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reporte: Piezas Pendientes por Proyecto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Piezas Pendientes de Fabricación</h3>
                            <button
                                @click="imprimirReporte"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center space-x-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                <span>Imprimir</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-6" id="reporte-content">
                        <!-- Resumen -->
                        <div class="mb-8">
                            <h4 class="text-md font-semibold text-gray-800 mb-4">Resumen General</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-600">Proyectos con Pendientes</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ proyectos.length }}</p>
                                </div>
                                <div class="bg-yellow-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-600">Total Piezas Pendientes</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ totalPiezasPendientes }}</p>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-600">Bloques Afectados</p>
                                    <p class="text-2xl font-bold text-green-600">{{ totalBloquesConPendientes }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Detalle por proyecto -->
                        <div v-for="proyecto in proyectos" :key="proyecto.id" class="mb-8">
                            <div class="border rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-6 py-4 border-b">
                                    <h4 class="text-lg font-semibold text-gray-800">
                                        {{ proyecto.codigo }} - {{ proyecto.nombre }}
                                    </h4>
                                    <p class="text-sm text-gray-600">{{ proyecto.descripcion }}</p>
                                </div>

                                <div class="p-6">
                                    <!-- Bloques del proyecto -->
                                    <div v-for="bloque in proyecto.bloques" :key="bloque.id" class="mb-6 last:mb-0">
                                        <h5 class="text-md font-medium text-gray-700 mb-3">
                                            Bloque: {{ bloque.codigo }} - {{ bloque.nombre }}
                                        </h5>

                                        <!-- Tabla de piezas pendientes -->
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Código
                                                        </th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Nombre
                                                        </th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Material
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
                                                    <tr v-for="pieza in bloque.piezas" :key="pieza.id">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ pieza.codigo }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ pieza.nombre }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ pieza.material || 'No especificado' }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ parseFloat(pieza.peso_teorico).toFixed(3) }}
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

                        <!-- Mensaje si no hay piezas pendientes -->
                        <div v-if="proyectos.length === 0" class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">¡Excelente trabajo!</h3>
                            <p class="text-gray-500">No hay piezas pendientes de fabricación en este momento.</p>
                        </div>
                    </div>

                    <!-- Pie del reporte -->
                    <div class="bg-gray-50 px-6 py-4 border-t">
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>Reporte generado el {{ fechaActual }}</span>
                            <Link :href="route('minucia.index')" class="text-indigo-600 hover:text-indigo-500">
                                Volver al Dashboard
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    proyectos: Array
})

const totalPiezasPendientes = computed(() => {
    return props.proyectos.reduce((total, proyecto) => {
        return total + proyecto.bloques.reduce((totalBloque, bloque) => {
            return totalBloque + bloque.piezas.length
        }, 0)
    }, 0)
})

const totalBloquesConPendientes = computed(() => {
    return props.proyectos.reduce((total, proyecto) => {
        return total + proyecto.bloques.length
    }, 0)
})

const fechaActual = computed(() => {
    return new Intl.DateTimeFormat('es-CO', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(new Date())
})

const imprimirReporte = () => {
    window.print()
}
</script>

<style>
@media print {
    .no-print {
        display: none;
    }

    .bg-gray-50 {
        background-color: #f9fafb !important;
    }

    .shadow-xl {
        box-shadow: none !important;
    }
}
</style>
